<?php

namespace ConstructionsIncongrues\Empilements\Cli\Command;

use Alchemy\Zippy\Zippy;
use ConstructionsIncongrues\Empilements\Collection\EmpilementCollection;
use ConstructionsIncongrues\Incongrukit\Console\Output\EventConsoleOutput;
use ConstructionsIncongrues\Incongrukit\Event\LogEvent;
use ConstructionsIncongrues\Incongrukit\Importer\CollectionImporter;
use ConstructionsIncongrues\Incongrukit\Log\EventDispatcherLogger;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Exception\RuntimeException;

class ImportCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('import')
            ->setDescription('Verifies, processes and imports the contents of a compilation archive')
            ->addArgument('archive', InputArgument::REQUIRED, 'Path to compilation archive')
            ->addArgument('destination', InputArgument::REQUIRED, 'Path to directory holding compilation')
            ->addArgument('title', InputArgument::REQUIRED, 'Compilation title')
            ->addArgument('authors', InputArgument::REQUIRED, 'Comma separated list of compilation authors')
            ->addOption(
                'workspaces',
                null,
                InputOption::VALUE_REQUIRED,
                'Path to directory holding temporary workspace directories',
                sys_get_temp_dir()
            )
            ->addOption('is-enabled', null, InputOption::VALUE_NONE, 'Mark compilation as enabled')
            ->addOption('is-featured', null, InputOption::VALUE_NONE, 'Mark compilation as featured')
            ->addOption('no-cleanup', null, InputOption::VALUE_NONE, 'Do not delete temporary workspace')
            ->addOption('date', null, InputOption::VALUE_REQUIRED, 'Compilation release date', date('Y-m-d'))
        ;
    }

    protected function execute(InputInterface $input, EventConsoleOutput $output)
    {
        try {
            // Setup signal handlers
            if (function_exists('pcntl_signal')) {
                declare(ticks = 100);
                pcntl_signal(SIGINT, function ($signal) {
                    // Real code happens in catch block but this is needed for exception to be thrown on SIGINT
                });
            }

            // Log
            $output->writeln(sprintf(
                '<info>Importing compilation "%s" from archive "%s" into directory "%s"</info>',
                $input->getArgument('title'),
                $input->getArgument('archive'),
                $input->getArgument('destination')
            ));

            // Compute authors
            $authors = array_map('trim', explode(',', $input->getArgument('authors')));

            // Create collection
            $collection = new EmpilementCollection(
                array(
                    'manifest' => array(
                        'date'        => $input->getOption('date'),
                        'is_enabled'  => $input->getOption('is-enabled'),
                        'is_featured' => $input->getOption('is-featured'),
                        'title'       => $input->getArgument('title'),
                        'authors'     => $authors
                    ),
                )
            );

            // Create logger
            if ($output->isVerbose()) {
                $eventDispatcher = new EventDispatcher();
                $eventDispatcher->addListener('constructionsincongrues.log', function (LogEvent $event) use ($output) {
                    $output->writelnFromLogEvent($event);
                });
                $logger = new EventDispatcherLogger($eventDispatcher);
                $collection->setLogger($logger);
            } else {
                $logger = new NullLogger();
            }

            // Create workspace directory
            $dirWorkspace = $input->getOption('workspaces').'/'.uniqid('empilements_');

            // Extract archive to workspace
            $fs = new Filesystem();
            if (is_dir($input->getArgument('archive'))) {
                $fs->mirror($input->getArgument('archive'), $dirWorkspace);
            } else {
                $fs->mkdir($dirWorkspace);
                $zippy = Zippy::load();
                $archive = $zippy->open($input->getArgument('archive'));
                $archive->extract($dirWorkspace);
            }

            // Import archive
            $importer = new CollectionImporter($dirWorkspace);
            $importer->setLogger($logger);
            $success = $importer->import(
                $dirWorkspace,
                $input->getArgument('destination'),
                $collection
            );

            // Handle errors
            $returnCode = 0;
            if (false === $success) {
                $output->writeln('<error>Archive could not be imported for the following reasons :</error>');
                foreach ($importer->getErrors() as $error) {
                    $output->writeln(sprintf('- <error>%s</error>', $error));
                }

                $returnCode = 255;
            }

            // Cleanup workspace
            if (!$input->getOption('no-cleanup')) {
                $importer->cleanup();
            }

            // Log
            if ($returnCode === 0) {
                $output->writeln('<info>Import successful</info>');
            } else {
                $output->writeln('<error>Import failed</error>');
            }

            // Successful exit
            return $returnCode;
        } catch (RuntimeException $e) {
            $output->writeln('<comment>Caught SIGINT, cleaning up and terminating</comment>');
            $importer->cleanup();
            return 2;
        }
    }
}
