<?php

namespace ConstructionsIncongrues\Empilements\Cli\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use ConstructionsIncongrues\Empilements\Collection\EmpilementCollection;
use ConstructionsIncongrues\Incongrukit\Console\Output\EventConsoleOutput;
use Psr\Log\NullLogger;
use Symfony\Component\EventDispatcher\EventDispatcher;
use ConstructionsIncongrues\Incongrukit\Log\EventDispatcherLogger;
use ConstructionsIncongrues\Incongrukit\Event\LogEvent;

class GenerateManifestCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('generate-manifest')
            ->setDescription('Generates manifest.json from compilation directory')
            ->addArgument('directory', InputArgument::REQUIRED, 'Path to compilation directory')
        ;
    }

    protected function execute(InputInterface $input, EventConsoleOutput $output)
    {
        // Create collection
        $collection = new EmpilementCollection(array('manifest' => array('title' => basename($input->getArgument('directory')))));

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

        $collection->buildFrom($input->getArgument('directory'));
        // $collection->verify();
        $collection->process();
}
}
