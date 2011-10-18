<?php
$compilation = filter_input(INPUT_GET, 'c');
require(dirname(__FILE__).'/lib.php');
$compilationsSpec = get_compilations_specs(dirname(__FILE__).'/compilations');
$compilation = filter_input(INPUT_GET, 'c'); 
$title = 'Empilements';
$descriptionCompilation = "Aux fils de nos agapes, à la lueur d'un songe insomniaque, depuis les tréfonds de la nuit, le besoin impérieux de constituer des compilations musicales se fait parfois sentir.";
if ($compilation) {
	$infos = $compilationsSpec[$compilation]['manifest'];
	$title = $compilationsSpec[$compilation]['title'];
	$tracks = $compilationsSpec[$compilation]['tracks'];
	$descriptionCompilation = $compilationsSpec[$compilation]['description'];
}
include('top.php');
if ($compilation) {
	include('compilation.php');
} else {
	include('homegrid.php');
}
include('bottom.php');
