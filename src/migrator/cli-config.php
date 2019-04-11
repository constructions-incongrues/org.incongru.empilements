<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

require_once(__DIR__.'/src/bootstrap.php');

$entityManager = EntityManager::create($dbParams, $config);
return ConsoleRunner::createHelperSet($entityManager);
