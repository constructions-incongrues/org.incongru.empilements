<?php
$compilation = filter_input(INPUT_GET, 'c');
include('top.php');
if ($compilation) {
	include('compilation.php');
}
include('bottom.php');