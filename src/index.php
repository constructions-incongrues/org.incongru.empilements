<?php
require_once __DIR__.'/../vendor/autoload.php'; 

// Imports
use Symfony\Component\HttpFoundation\Response;

// Application configuration
$app = new Silex\Application(); 

// Debug mode trigger
if (filter_input(INPUT_GET, 'debug')) {
	$app['debug'] = true;
}

// Silex service providers
// -- Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
	'twig.path' => __DIR__.'/views',
));

// -- URL generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Twig extensions
$app['twig']->addExtension(new Twig_Extensions_Extension_Text());

// Controllers
// -- homepage
$app->get('/', function() use($app) {
	// Common texts
	$title = 'Empilements';
	$description = "Aux fils de nos agapes, à la lueur d'un songe insomniaque, depuis les tréfonds de la nuit, le besoin impérieux de constituer des compilations musicales se fait parfois sentir.";

	// Parse compilations specifications
	require(__DIR__.'/lib/helpers.php');
	$compilationsSpec = get_compilations_specs(__DIR__.'/var/compilations');

	// Render view
	return $app['twig']->render('homepage.twig', array('title' => $title, 'description' => $description, 'compilationsSpec' => $compilationsSpec)); 
})->bind('homepage');

// -- view compilation
$app->get('/{name}', function($name) use($app) {
	// Common texts
	$title = 'Empilements';
	$description = "Aux fils de nos agapes, à la lueur d'un songe insomniaque, depuis les tréfonds de la nuit, le besoin impérieux de constituer des compilations musicales se fait parfois sentir.";

	// Parse compilations specifications
	require(__DIR__.'/lib/helpers.php');
	$compilationsSpec = get_compilations_specs(__DIR__.'/var/compilations');
	$compilationIsEnabled = $name && isset($compilationsSpec[$name]) && $compilationsSpec[$name]['manifest']['is_enabled'] == true;
	if ($compilationIsEnabled || filter_input(INPUT_GET, 'mode') == 'preview') {
		$infos = $compilationsSpec[$name]['manifest'];
		$title = $compilationsSpec[$name]['title'];
		$tracks = array();
		foreach ($compilationsSpec[$name]['tracks'] as $track) {
			$tracks[] = array(
				'url'  => sprintf('var/compilations/%s/tracks/%s', $name, rawurlencode(basename($track))), 
				'name' => preg_replace('/^\d\d - (.*)$/', '${1}', basename($track, '.mp3'))
				);
		}
		$description = $compilationsSpec[$name]['description'];
	}

	// Render view
	return $app['twig']->render('compilation.twig', array(
		'title' => $title, 
		'description' => $description, 
		'compilationsSpec' => $compilationsSpec, 
		'compilation' => $name, 
		'tracks' => $tracks, 
		'infos' => $infos)
	); 
})->bind('compilation');

// -- download compilation
$app->get('/feed', function($name, Response $response) use($app) {
	// List of available compilations
	require(__DIR__.'/lib/helpers.php');
	$compilations = array_keys(get_compilations_specs(__DIR__.'/compilations'));
print_r($response);exit;
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

	// Create feed entries
	$timestampNewest = 0;
	foreach ($compilations as $compilation) {
		// Gather compilation informations
		$pathManifest = sprintf('%s/var/compilations/%s/manifest.ini', __DIR__, $compilation);
		$manifest = parse_ini_file($pathManifest);
		if ($manifest['is_enabled'] != true) {
			continue;
		}
		$statManifest = stat($pathManifest);
		if ($statManifest['mtime'] > $timestampNewest) {
			$timestampNewest = $statManifest['mtime'];
		}
		$tracks = glob(sprintf('%s/var/compilations/%s/tracks/*.mp3', __DIR__, $compilation));
		$entryBody = array();
		$entryBody[] = '<ol>';
		foreach ($tracks as $track) {
			$entryBody[] = sprintf('<li>%s</li>', preg_replace('/^\d+\d+ - (.*)$/', '$1', basename($track, '.mp3')));
		}
		$entryBody[] = sprintf('<img src="http://empilements.incongru.org/compilations/%s/cover.gif" />', $compilation);
		$entryBody[] = '</ol>';
		$entries[$statManifest['mtime']] = array(
			'manifest'	=> $manifest,
			'body'		=> $entryBody
		);
	}

	ksort($entries, SORT_NUMERIC);
	$entries = array_reverse($entries, true);
	foreach ($entries as $mtime => $item) {
		// Create entry
		$entry = $feed->createEntry();
		$entry->setTitle(sprintf('%s, par %s', $item['manifest']['title'], $item['manifest']['authors']));
		$entry->setLink($item['manifest']['url']);
		$entry->setContent(implode("\n", $item['body']));
		$entry->setDateCreated($mtime);
		$entry->setDateModified($mtime);
		$feed->addEntry($entry);
	}

	$feed->setDateModified($timestampNewest);

	// Serve feed
	$xml = $feed->export('rss');
	// header('Content-type:application/rss+xml;charset=utf8');
	// header('Content-length:'.strlen($xml));
	// echo $xml;

})->bind('feed');

// Run application
$app->run();