<?php
$compilation = filter_input(INPUT_GET, 'c');
$mode = 'web';
if (!$compilation) {
	$compilation = $_SERVER['argv'][1];
	$mode = 'cli';
}
$pathZip = sprintf(dirname(__FILE__).'/cache/empilements_%s.zip', $compilation);
if (!file_exists($pathZip)) {
	$tracks = glob(sprintf('%s/compilations/%s/tracks/*.mp3', dirname(__FILE__), $compilation));
	$infos = parse_ini_file(sprintf('%s/compilations/%s/manifest.ini', dirname(__FILE__), $compilation));
	$zip = new ZipArchive();
	
	$zip->open($pathZip, ZipArchive::CREATE);
	foreach ($tracks as $track) {
		$zip->addFile($track, sprintf('%s/%s', $infos['title'], basename($track)));
	}
	$zip->addFile(sprintf('%s/compilations/%s/cover.gif', dirname(__FILE__), $compilation), sprintf('%s/cover.gif', $infos['title']));
	$zip->addFile(sprintf('%s/compilations/%s/manifest.ini', dirname(__FILE__), $compilation), sprintf('%s/manifest.ini', $infos['title']));
	$zip->close();
}

if ($mode == 'web') {
	$contents = file_get_contents($pathZip);
	header('Content-Type: application/zip');
	header('Content-Length:'.strlen($contents));
	header('Content-Disposition:attachment;filename='.basename($pathZip));
	echo $contents;
	unset($contents);
}