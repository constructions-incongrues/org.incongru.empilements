<?php
// List of available compilations
$compilations = array('savage-desktop-clean-out', 'buttfetishvol2', 'eventail');

// Setup autoloading
set_include_path(get_include_path().PATH_SEPARATOR.'/usr/share/php');
require_once('Zend/Loader/Autoloader.php');
Zend_Loader_Autoloader::getInstance();

// Create feed
$feed = new Zend_Feed_Writer_Feed;
$feed->setTitle('Empilements | incongru.org');
$feed->setLink('http://empilements.incongru.org');
$feed->setFeedLink('http://feeds.feedburner.com/empilements-incongrus', 'rss');
$feed->setDescription("Aux fils de nos agapes, à la lueur d'un songe insomniaque, depuis les tréfonds de la nuit, le besoin impérieux de constituer des compilations musicales se fait parfois sentir.");
$feed->addAuthor(array(
    'name'  => 'Empilements',
    'email' => 'empilements@incongru.org',
    'uri'   => 'http://empilements.incongru.org'
));
$feed->setDateModified(time());

// Create feed entries
foreach ($compilations as $compilation) {
	// Gather compilation informations
	$pathManifest = sprintf('%s/compilations/%s/manifest.ini', dirname(__FILE__), $compilation);
	$manifest = parse_ini_file($pathManifest);
	$statManifest = stat($pathManifest);
	$tracks = glob(sprintf('%s/compilations/%s/tracks/*.mp3', dirname(__FILE__), $compilation));
	$entryBody = array();
	$entryBody[] = '<ol>';
	foreach ($tracks as $track) {
		$entryBody[] = sprintf('<li>%s</li>', preg_replace('/^\d+\d+ - (.*)$/', '$1', basename($track, '.mp3')));
	}
	$entryBody[] = sprintf('<img src="http://empilements.incongru.org/%s/logo.png" />', $compilation);
	$entryBody[] = '</ol>';
	
	// Create entry
	$entry = $feed->createEntry();
	$entry->setTitle(sprintf('%s, par %s', $manifest['title'], $manifest['authors']));
	$entry->setLink($manifest['url']);
	$entry->setContent(implode("\n", $entryBody));
	$entry->setDateCreated($statManifest['mtime']);
	$entry->setDateModified($statManifest['mtime']);
	$feed->addEntry($entry);
}

// Serve feed
$xml = $feed->export('rss');
header('Content-type:application/rss+xml;charset=utf8');
header('Content-length:'.strlen($xml));
echo $xml;
