<?php

namespace ConstructionsIncongrues\Empilements\Collection;

use Alchemy\Zippy\Zippy;
use ConstructionsIncongrues\Incongrukit\Collection\FileCollection;
use Intervention\Image\Image;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Process\Process;

class EmpilementCollection extends FileCollection
{
    private $filesystem;

    public function configure()
    {
        // Audio files
        $this->addGroup('audio', array(
            'patternGroup' => '*.mp3',
            'patternFile'  => '/^(\d+) - (.*) - (.*).mp3$/',
            'countMin'     => 1,
        ));

        // Image files
        $this->addGroup('image', array('patternGroup' => '/\.(jpg|gif|png)/', 'countMin' => 1));

        // Create slug from title
        $this->parameters['slug'] = $this->slugify($this->parameters['manifest']['title']);

        // For filesystem operations
        $this->filesystem = new Filesystem();
    }

    // TODO : group errors (also from parent)
    public function verify()
    {
        // Run common checks
        parent::verify();

        // Check image size
        $specImage = getimagesize($this->getGroup('image')['files'][0]->getPathname());
        if ($specImage[0] < 300 || $specImage[1] < 300) {
            $this->errors[] = sprintf(
                'Wrong image size %s',
                json_encode(
                    array(
                        'widthMin'    => 300,
                        'widthImage'  => $specImage[0],
                        'heightMin'   => 300,
                        'heightImage' => $specImage[1]
                    ),
                    JSON_UNESCAPED_SLASHES
                )
            );
        }

        // Check duration < 80 minutes
        $id3 = new \getID3();
        $secondsMax = 60 * 80;
        $secondsTotal = 0;
        foreach ($this->getGroup('audio')['files'] as $file) {
            $secondsTotal += $id3->analyze($file->getPathname())['playtime_seconds'];
        }
        if ($secondsTotal > $secondsMax) {
            $this->errors[] = sprintf(
                'Total playtime is too long %s',
                json_encode(
                    array('secondsTotal' => $secondsTotal, 'secondsMax' => $secondsMax),
                    JSON_UNESCAPED_SLASHES
                )
            );
        }

        // Handle errors
        if (count($this->errors)) {
            return false;
        }

        return true;
    }

    public function process()
    {
        parent::process();

        // Collection manifest
        $manifest = array_merge(
            $this->parameters['manifest'],
            array('playlist' => array(), 'url' => 'http://empilements.incongru.org?c='.$this->parameters['slug'])
        );

        // Files to  be included in archive
        $archiveMembers = array();

        // Normalize
        $this->logger->info(
            '[processing] Normalizing audio files',
            array('collection' => $this->getId(), 'filesCount' => count($this->getGroup('audio')['files']))
        );
        $process = new Process(
            sprintf(
                'mp3gain -r -k -t -q %s',
                implode(' ', array_map('escapeshellarg', $this->getGroup('audio')['files']))
            )
        );
        $process->run(function ($type, $buffer) {
            if ('err' === $type) {
                $this->logger->error(sprintf('[processing] %s', trim($buffer)));
            } else {
                $this->logger->debug(sprintf('[processing] %s', trim($buffer)));
            }
        });
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        // audio : Tag
        $this->logger->info(
            '[processing] Tagging audio files',
            array('collection' => $this->getId(), 'filesCount' => count($this->getGroup('audio')['files']))
        );
        foreach ($this->getGroup('audio')['files'] as $file) {
            // Extract track info from filename
            $matches = array();
            preg_match($this->getGroup('audio')['patternFile'], basename($file->getPathname()), $matches);
            list($filename, $trackNumber, $trackArtist, $trackTitle) = $matches;

            // Tag file
            $id3 = new \getid3_writetags();
            $id3->filename = $file->getPathname();
            $id3->tagformats = array('id3v1', 'id3v2.3', 'id3v2.4');
            $id3->overwrite_tags = true;
            $id3->remove_other_tags = true;
            $id3->tag_encoding = 'UTF-8';
            $id3->tag_data = array(
                'album'   => array($this->parameters['manifest']['title']),
                'artist'  => array($trackArtist),
                'comment' => array('http://empilements.incongru.org?c='.$this->parameters['slug']),
                'title'   => array($trackTitle),
                'track'   => array($trackNumber)
            );
            $success = $id3->WriteTags();
            if ($success) {
                $archiveMembers[] = $file->getPathname();
                foreach ($id3->warnings as $warning) {
                    $this->logger->warning(sprintf('[processing/id3] %s', $warning));
                }
                // Build manifest's playlist
                $manifest['playlist'][(int)$trackNumber] = array(
                    'track' => $trackNumber,
                    'artist' => $trackArtist,
                    'title' => $trackTitle
                );
            } else {
                throw new \RuntimeException(
                    sprintf(
                        'An error occured while tagging audio files %s',
                        json_encode(array('errors' => $id3->errors), JSON_UNESCAPED_SLASHES)
                    )
                );
            }

        }

        // Create images
        $this->logger->info(
            '[processing] Editing images',
            array('collection' => $this->getId(), 'imgSource' => $this->getGroup('image')['files'][0]->getPathname())
        );
        Image::make($this->getGroup('image')['files'][0]->getPathname())
            ->save($this->path.'/source.jpg');
        $archiveMembers[] = $this->path.'/source.jpg';
        Image::make($this->getGroup('image')['files'][0]->getPathname())
            ->resizeCanvas(350, 350, 'center')
            ->save($this->path.'/cover.gif');
        $archiveMembers[] = $this->path.'/cover.gif';
        Image::make($this->getGroup('image')['files'][0]->getPathname())
            ->resizeCanvas(200, 100, 'center')
            ->save($this->path.'/thumb_100_200.gif');
        $archiveMembers[] = $this->path.'/thumb_100_200.gif';

        // Generate manifest.json
        $this->logger->info(
            '[processing] Generating manifest.json',
            array('collection' => $this->getId(), 'manifest' => $manifest)
        );

        ksort($manifest);
        ksort($manifest['playlist']);
        $success = file_put_contents(
            $this->path.'/manifest.json',
            json_encode($manifest, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
        );
        $archiveMembers[] = $this->path.'/manifest.json';
        if (!$success) {
            throw new \RuntimeException(
                sprintf(
                    "Could not write manifest file %s",
                    json_encode(array('file' => $this->path.'/manifest.json'), JSON_UNESCAPED_SLASHES)
                )
            );
        }

        // Create archive
        $pathArchive = sprintf('%s/%s.zip', $this->path, $this->parameters['slug']);
        $this->logger->info(
            '[processing] Creating archive',
            array('collection' => $this->getId(), 'path' => $pathArchive, 'contents' => $archiveMembers)
        );
        $dirArchive = sprintf('%s/Empilements - %s', $this->path, $manifest['title']);
        $this->filesystem->mkdir($dirArchive);
        foreach ($archiveMembers as $filepath) {
            $this->filesystem->rename($filepath, sprintf('%s/%s', $dirArchive, basename($filepath)));
        }
        $zippy = Zippy::load();
        $zippy->create($pathArchive, $dirArchive);
        $this->logger->notice(
            '[processing] Created archive',
            array('collection' => $this->getId(), 'path' => $pathArchive)
        );

        // Cleanup
        $this->logger->notice('[processing] Cleaning up', array('collection' => $this->getId()));
        if (basename($this->getGroup('image')['files'][0]->getPathname()) != 'source.jpg') {
            $this->filesystem->remove($this->getGroup('image')['files'][0]->getPathname());
        }

        // Log
        $this->logger->notice('[processing] Collection processing succeeded', array('collection' => $this->getId()));

        return true;
    }

    public function deploy($destination)
    {
        // Destination directory
        $destination = $destination.'/'.$this->parameters['slug'];
        parent::deploy($destination);

        // Deploy files
        $this->filesystem->mkdir($destination.'/tracks');
        $finder = new Finder();

        // Files in folder root
        $filesRoot = $finder
            ->name('cover.gif')
            ->name('thumb_100_200.gif')
            ->name('source.jpg')
            ->name('manifest.json')
            ->name('*.zip')
            ->in($this->path);
        foreach ($filesRoot as $file) {
            $this->filesystem->copy($file->getPathname(), $destination.'/'.$file->getBasename());
        }

        // Files in tracks directory
        $filesMp3 = $finder->name('*.mp3')->in($this->path);
        foreach ($filesMp3 as $file) {
            $this->filesystem->copy($file->getPathname(), $destination.'/tracks/'.$file->getBasename());
        }
    }

    /**
     * Modifies a string to remove all non ASCII characters and spaces.
     */
    private function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        if (function_exists('iconv')) {
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        }

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
}
