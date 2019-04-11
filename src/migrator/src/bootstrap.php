<?php
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Tools\Setup;

require_once(__DIR__.'/../vendor/autoload.php');

$paths = array(__DIR__."/Entities");
$isDevMode = true;

// the connection configuration
$dbParams = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'db',
    'user'     => 'root',
    'password' => 'root',
    'dbname'   => 'empilements',
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);

$cache = new \Doctrine\Common\Cache\ArrayCache();

$reader = new AnnotationReader();
$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, $paths);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setMetadataCacheImpl( $cache );
$config->setQueryCacheImpl( $cache );
$config->setMetadataDriverImpl( $driver );
