<?php
/**
 * Parses compilations directories and generates an array of specifications for each compilation.
 * 
 * @param string $directory Root path
 * 
 * @return array
 */
function get_compilations_specs($directory) {
	$compilations = array_map('basename', glob($directory.'/*', GLOB_ONLYDIR));
	$compilationsSpec = array();
	foreach ($compilations as $compilation) {
		// Extract manifest data and playlists
		$compilationsSpec[$compilation] = array(
			'manifest' 	=> parse_ini_file(sprintf('%s/compilations/%s/manifest.ini', dirname(__FILE__), $compilation)),
			'tracks'	=> glob(sprintf('%s/compilations/%s/tracks/*.mp3', dirname(__FILE__), $compilation)),
		);
		
		// Generate compilation artists list
		$artists = array();
		foreach ($compilationsSpec[$compilation]['tracks'] as $track) {
			$parts = explode(' - ', $track);
			$artists[] = $parts[1];
		}
		$compilationsSpec[$compilation]['artists'] = $artists;
		
		// Generate compilation description (used in ogp)
		$compilationsSpec[$compilation]['description'] = sprintf(
			'%d titres sélectionnés avec amour par %s. Avec : %s', 
			count($compilationsSpec[$compilation]['tracks']), 
			$compilationsSpec[$compilation]['manifest']['authors'],
			implode(', ', $compilationsSpec[$compilation]['artists'])
		);
		
		// Generate compilation page title
		$compilationsSpec[$compilation]['title'] = sprintf('%s | Empilements', $compilationsSpec[$compilation]['manifest']['title']);
	}

	return $compilationsSpec;
}

/**
* Truncates +text+ to the length of +length+ and replaces the last three characters with the +truncate_string+
* if the +text+ is longer than +length+.
*/
function truncate_text($text, $length = 30, $truncate_string = '...', $truncate_lastspace = false)
{
	if ($text == '')
	{
		return '';
	}

	$mbstring = extension_loaded('mbstring');
	if($mbstring)
	{
		$old_encoding = mb_internal_encoding();
		@mb_internal_encoding(mb_detect_encoding($text));
	}
	$strlen = ($mbstring) ? 'mb_strlen' : 'strlen';
	$substr = ($mbstring) ? 'mb_substr' : 'substr';

	if ($strlen($text) > $length)
	{
		$truncate_text = $substr($text, 0, $length - $strlen($truncate_string));
		if ($truncate_lastspace)
		{
			$truncate_text = preg_replace('/\s+?(\S+)?$/', '', $truncate_text);
		}
		$text = $truncate_text.$truncate_string;
	}

	if($mbstring)
	{
		@mb_internal_encoding($old_encoding);
	}

	return $text;
}