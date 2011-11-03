<?php
$compilation = filter_input(INPUT_GET, 'c');
$tracks = glob(sprintf('%s/compilations/%s/tracks/*.mp3', dirname(__FILE__), $compilation));
$infos = parse_ini_file(sprintf('%s/compilations/%s/manifest.ini', dirname(__FILE__), $compilation));
$zip = new ZipArchive();
$pathZip = sprintf(dirname(__FILE__).'/tmp/%s.zip', uniqid('empilements_'));
$zip->open($pathZip, ZipArchive::CREATE);
foreach ($tracks as $track) {
	$zip->addFile($track, sprintf('%s/%s', $infos['title'], basename($track)));
}
$zip->addFile(sprintf('%s/compilations/%s/cover.gif', dirname(__FILE__), $compilation), sprintf('%s/cover.gif', $infos['title']));
$zip->addFile(sprintf('%s/compilations/%s/manifest.ini', dirname(__FILE__), $compilation), sprintf('%s/manifest.ini', $infos['title']));
$zip->close();
$contents = file_get_contents($pathZip);
unlink($pathZip);
header('Content-Type: application/zip');
header('Content-Length:'.strlen($contents));
header('Content-Disposition:attachment;filename='.sprintf('empilements-%s.zip', $compilation));
echo $contents;
unset($contents);
?>
