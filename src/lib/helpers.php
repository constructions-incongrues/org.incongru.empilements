<?php
/**
 * Parses compilations directories and generates an array of specifications for each compilation.
 *
 * @param string $directory Root path
 *
 * @return array
 */
function get_compilations_specs($directory)
{
    $compilations = array_map('basename', glob($directory.'/*', GLOB_ONLYDIR));
    $compilationsSpec = array();
    foreach ($compilations as $compilation) {
        // Extract manifest data and playlists
        $pathManifest = sprintf('%s/../public/var/compilations/%s/manifest.json', __DIR__, $compilation);
        if (!is_readable($pathManifest)) {
            continue;
        }
        $manifest = json_decode(file_get_contents($pathManifest), true);
        if (!$manifest) {
            continue;
        }
        $compilationsSpec[$compilation] = array(
            'name'      => $compilation,
            'manifest'  => $manifest
        );

        // Generate compilation artists list
        $artists = array();
        foreach ($compilationsSpec[$compilation]['manifest']['playlist'] as $track) {
            $artists[] = ucwords($track['artist']);
        }
        $compilationsSpec[$compilation]['manifest']['artists'] = $artists;


        // Generate compilation description (used in ogp)
        $compilationsSpec[$compilation]['manifest']['description'] = sprintf(
            '%d titres sélectionnés avec amour par %s. Avec : %s',
            count($compilationsSpec[$compilation]['manifest']['playlist']),
            implode(', ', $compilationsSpec[$compilation]['manifest']['authors']),
            implode(', ', $compilationsSpec[$compilation]['manifest']['artists'])
        );


        // Generate compilation page title
        $compilationsSpec[$compilation]['title'] = sprintf(
            '%s | Empilements',
            $compilationsSpec[$compilation]['manifest']['title']
        );
    }

    return $compilationsSpec;
}
