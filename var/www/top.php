<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr" xmlns:og="http://ogp.me/ns#"> <!--<![endif]-->
<head>
<meta charset="utf-8">

<!-- Use the .htaccess and remove these lines to avoid edge case issues.
More info: h5bp.com/b/378 -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php echo $title ?></title>
<meta name="description" content="<?php echo $descriptionCompilation ?>">

<meta property="og:title" content="<?php echo $title ?>" />
<meta property="og:type" content="music.album" />
<meta property="og:locale" content="fr_fr" />
<meta property="og:description" content="<?php echo $descriptionCompilation ?>" />
<?php if ($compilation): ?>
<meta property="og:image" content="<?php echo sprintf('http://empilements.incongru.org/compilations/%s/cover.gif', $compilation) ?>" />
<?php endif; ?>

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

<!-- CSS: implied media=all -->
<!-- CSS concatenated and minified via ant build script-->
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.3.0/bootstrap.min.css">
  <link href='http://fonts.googleapis.com/css?family=Nova+Slim' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Comfortaa' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/empilements.css?v=<?php echo time() ?>">
  <!-- end CSS-->

<!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
<link rel="alternate" type="application/rss+xml" title="RSS" href="http://feeds.feedburner.com/empilements-incongrus">

<!-- All JavaScript at the bottom, except for Modernizr / Respond.
Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->
<script src="js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="span16">
				<h1 id="header"><a href="index.php"><img src="img/header.png" title="Retourner à l'accueil" /></a></h1>
				<p class="description">
		Aux fils de nos agapes, à la lueur d'un songe insomniaque, depuis les tréfonds de la nuit, le besoin impérieux de constituer des compilations musicales se fait parfois sentir.
				</p>
			</div>
		</div><!-- /div.row -->
