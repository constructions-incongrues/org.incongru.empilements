<?php
function get_compilations_specs($directory) {
	$compilations = array_map('basename', glob($directory.'/*', GLOB_ONLYDIR));
	$compilationsSpec = array();
	foreach ($compilations as $compilation) {
		$compilationsSpec[$compilation] = array(
			'manifest' 	=> parse_ini_file(sprintf('%s/compilations/%s/manifest.ini', dirname(__FILE__), $compilation)),
			'tracks'	=> glob(sprintf('%s/compilations/%s/tracks/*.mp3', dirname(__FILE__), $compilation)),
		);
		$compilationsSpec[$compilation]['description'] = sprintf(
			'%d titres sélectionnés avec amour par %s.', 
			count($compilationsSpec[$compilation]['tracks']), 
			$compilationsSpec[$compilation]['manifest']['title']
		);
		$compilationsSpec[$compilation]['title'] = sprintf('%s | Empilements', $compilationsSpec[$compilation]['manifest']['title']);
	}

	return $compilationsSpec;
}
