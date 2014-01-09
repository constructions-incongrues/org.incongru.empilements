<?php
namespace ConstructionsIncongrues\Empilements\Cli;

use ConstructionsIncongrues\Empilements\Cli\Command\ImportCommand;

class Application extends \Symfony\Component\Console\Application
{
    public function __construct()
    {
        parent::__construct('empilements', '0.1.0');
    }

    protected function getDefaultCommands()
    {
        $commands = parent::getDefaultCommands();
        $commands[] = new ImportCommand();
        return $commands;
    }
}
