<?php
use Doctrine\ORM\EntityManager;
use Symfony\Component\Finder\Finder;

// Setup Doctrine
require_once(__DIR__.'/bootstrap.php');
$em = EntityManager::create($dbParams, $config);

// Helpers
function logMessage($message, $data = [], $category = 'default')
{
    echo sprintf("[%s] [%s] %s - %s \n", date('r'), $category, $message, json_encode($data));
}

// Erase existing data
$connection = $em->getConnection();
$platform = $connection->getDatabasePlatform();
$connection->executeUpdate($platform->getTruncateTableSQL('artist', true));
$connection->executeUpdate($platform->getTruncateTableSQL('curator', true));
$connection->executeUpdate($platform->getTruncateTableSQL('directus_files', true));
$connection->executeUpdate($platform->getTruncateTableSQL('empilement', true));
$connection->executeUpdate($platform->getTruncateTableSQL('empilement_curator', true));
$connection->executeUpdate($platform->getTruncateTableSQL('empilement_track', true));
$connection->executeUpdate($platform->getTruncateTableSQL('track', true));
$connection->executeUpdate($platform->getTruncateTableSQL('track_artist', true));
$queryBuilder = $em->createQueryBuilder();
$queryBuilder->delete(Empilements\Entities\DirectusUsers::class, 'u')
   ->where('u.id != :id')
   ->setParameter('id', 1);
$query = $queryBuilder->getQuery();
$query->execute();
$queryBuilder = $em->createQueryBuilder();
$queryBuilder->delete(Empilements\Entities\DirectusUserRoles::class, 'ur')
   ->where('ur.user IS NULL');
$query = $queryBuilder->getQuery();
$query->execute();

// Parse manifests
$finder = new Finder();
$finder->files()->name('manifest.json')->in(__DIR__.'/../../public/var/compilations');

foreach ($finder as $file) {
    $manifest = json_decode(file_get_contents($file->getRealPath()), true);
    logMessage('Starting import', [], basename(dirname($file->getRealPath())));

    // Create Empilement
    $empilement = new Empilements\Entities\Empilement;
    $empilement->setTitle($manifest['title']);
    $empilement->slug = basename(dirname($file->getRealPath()));
    $empilement->setPublishedOn(\DateTime::createFromFormat('Y-m-d', $manifest['date']));
    $empilement->setStatus('published');
    $em->persist($empilement);
    $em->flush();

    logMessage('Importing curator', ['name' => $manifest['authors']], $empilement->slug);
    foreach ($manifest['authors'] as $name) {
        $curator = $em->getRepository('Empilements\Entities\Curator')->findOneBy(array('name' => $name));
        if (!$curator) {
            $curator = new Empilements\Entities\Curator;
            $curator->name = $name;
            $em->persist($curator);
            $em->flush();
            logMessage('Creating curator user', ['name' => $curator->name], $empilement->slug);
            $user = new Empilements\Entities\DirectusUsers;
            $user->status = 'active';
            $user->lastName = '';
            $user->firstName = $curator->name;
            $email = sprintf('%s@empilements.incongru.org', $curator->name);
            $user->email = $email;
            $user->password = '$2y$10$74FLxsPKPS6a0BUvDKNn4u4/e7cHNodpjrVQGHYhjoUhglb6TIT22';
            $user->timezone = 'Europe/Paris';
            $user->locale = 'fr-FR';
            $em->persist($user);
            $em->flush();
            $role = $em->getRepository('Empilements\Entities\DirectusRoles')->findOneBy(array('name' => 'Curator'));
            $relation = new Empilements\Entities\DirectusUserRoles;
            $relation->role = $role->id;
            $relation->user = $user->id;
            $curator->createdBy = $user->id;
            $curator->createdOn = new \DateTime;
            $em->persist($curator);
            $em->persist($relation);
            $em->flush();
        }
        $relation = new Empilements\Entities\EmpilementCurator;
        $relation->curatorId = $curator->id;
        $relation->empilementId = $empilement->id;
        $em->persist($relation);
        $em->flush();
    }

    $user = $em->getRepository('Empilements\Entities\DirectusUsers')->findOneBy(array('firstName' => $manifest['authors'][0]));
    $empilement->createdBy = $user->id;
    $empilement->createdOn = new \DateTime;
    $em->persist($empilement);
    $em->flush();

    logMessage('Importing cover', [], $empilement->slug);
    $cover = new Empilements\Entities\DirectusFiles;
    $cover->setTitle(sprintf('%s', $empilement->title));
    $cover->setType('image/gif');
    $cover->setUploadedBy($user->id);
    $cover->setUploadedOn(new DateTime);
    $cover->filename = sprintf(
        'var/compilations/%s/cover.gif',
        $empilement->slug
    );
    $em->persist($cover);
    $em->flush();
    $empilement->cover = $cover->id;
    $em->persist($empilement);

    // Create tracks and artists
    foreach ($manifest['playlist'] as $position => $track) {
        $name = $track['artist'];
        $title = $track['title'];
        if ($em->getRepository('Empilements\Entities\Artist')->findOneBy(array('name' => $name)) === null) {
            logMessage('Importing artist', ['name' => $name], $empilement->slug);
            $artist = new Empilements\Entities\Artist;
            $artist->setName($name);
            $artist->createdBy = $user->id;
            $artist->createdOn = new \DateTime;
            $em->persist($artist);

            logMessage('Importing track', ['position' => $position, 'title' => $title], $empilement->slug);
            $track = new Empilements\Entities\Track;
            $track->setTitle($title);
            $track->setPosition($position);
            $track->createdBy = $user->id;
            $track->createdOn = new \DateTime;
            $em->persist($track);
            $em->flush();

            logMessage('Importing track audio file', ['track' => $title], $empilement->slug);
            $audio = new Empilements\Entities\DirectusFiles;
            $audio->setTitle(sprintf('%s - %s', $name, $title));
            $audio->setType('audio/mpeg');
            $audio->setUploadedBy(1);
            $audio->setUploadedOn(new DateTime);
            $audio->filename = sprintf(
                'var/compilations/%s/tracks/%s - %s - %s.mp3',
                $empilement->slug,
                $position < 10 ? '0'.$position : $position,
                $artist->name,
                $track->title
            );
            $audio->createdBy = $user->id;
            $audio->createdOn = new \DateTime;
            $em->persist($audio);
            $em->flush();

            logMessage('Creating track / file relation', ['track' => $title, 'file' => $audio->filename], $empilement->slug);
            $track->setAudio($audio->getId());
            $em->persist($track);
            $em->flush();

            logMessage('Creating artist / track relation', ['artist' => $name, 'track' => $title], $empilement->slug);
            $relation = new Empilements\Entities\TrackArtist;
            $relation->setTrackId($track->getId());
            $relation->setArtistId($artist->getId());
            $em->persist($relation);
            $em->flush();

            logMessage('Creating track / empilement relations', ['empilement' => $manifest['title'], 'track' => $title], $empilement->slug);
            $relation = new Empilements\Entities\EmpilementTrack;
            $relation->empilementId = $empilement->id;
            $relation->trackId = $track->getId();
            $em->persist($relation);
            $em->flush();
        }
    }

    logMessage('Import completed', [], $empilement->slug);
}
