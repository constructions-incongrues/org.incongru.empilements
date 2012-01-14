<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="fr">
<!--<![endif]-->
<head>
<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo $title ?></title>

	<meta name="description" content="<?php echo $descriptionCompilation ?>">
	<meta property="og:title" content="<?php echo $title ?>" />
	<meta property="og:type" content="music.album" />
	<meta property="og:locale" content="fr_fr" />
	<meta property="og:description" content="<?php echo $descriptionCompilation ?>" />
	<?php if ($compilation): ?>
	<meta property="og:image" content="<?php echo sprintf('http://empilements.incongru.org/compilations/%s/cover.gif', $compilation) ?>" />
	<?php else: ?>
	<meta property="og:image" content="http://empilements.incongru.org/img/header.png" />
	<?php endif; ?>

	<link rel="shortcut icon" type="image/png" href="empilements_16x16.png"/>

	<meta name="viewport" content="width=device-width,initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root of your domain and delete these references -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
  
	<link rel="stylesheet" type="text/css" media="all" href="css/lib/960.gs/reset.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="css/lib/960.gs/text.css"/>
	<link rel="stylesheet" type="text/css" media="all" href="css/lib/960.gs/960.css"/>

	<link rel="stylesheet" href="css/empilements.css?v=1">
	<link rel="stylesheet" href="css/magic.css?v=1">
	<link rel="stylesheet" href="css/gradient.css?v=1">

	<!-- More ideas for your <head> here: h5bp.com/d/head-Tips -->
	<link rel="alternate" type="application/rss+xml" title="Se tenir informer des nouvelles sorties" href="http://feeds.feedburner.com/empilements-incongrus">

	<link href='http://fonts.googleapis.com/css?family=Terminal+Dosis:400,500,600,700,800' rel='stylesheet' type='text/css'>

	<script src="js/libs/modernizr-2.0.6.min.js"></script>
	<script type="text/javascript" src="js/prefixfree.min.js"></script>
</head>

<body>
			
<div class="container_12">

<h1 class="grid_6 logo"><a href="index.php"><img src="pics/logo.png" alt="Empilements"/></a></h1>

<?php if ($compilation): ?> 
<ul class="grid_6 nav-1">
<li><a href="download.php?c=<?php echo $compilation ?>" onClick="javascript: _gaq.push(['_trackPageview', '/downloads/<?php echo $compilation ?>']);">Télécharger</a> <img src="pics/play.png" alt="" /></li>
<li><a class="medialink play"><a href="" class="play">Ecouter</a><img src="pics/v.png" /></li>
</ul>
<?php endif; ?>

<div class="clear"></div>

<div class="grid_4 navbar grad-1">
<p class="bgfix">e</p>

<div class="man">
<!--
<img src="pics/navbar/descr.png" alt="" style="margin-left:0px;"/>
-->
<p class="descr grad-3">
	Aux fils de nos agapes, à la lueur d'un songe insomniaque, depuis les tréfonds de la nuit, le besoin impérieux de constituer des compilations musicales se fait parfois sentir.
</p>
</div><!-- .man -->
<img src="pics/navbar/hand.png" alt="" class="hand" style=""/>

<p class="submit">N'hésitez surtout pas à <br/>nous soumettre vos <br/>compilations ! </p>

<div class="triangle">
								
	</div>
								
<div class="footer grad-2">
	
<h2 class="go"><a href="mailto:empilements@incongru.org">Go! &gt;&gt;&gt;</a></h2>
<p>	
Ce projet est développé par 
<a href="">Constructions Incongrues </a>
et hébergé par <a href="">Pastis Hosting</a>
</p>

<p>Design par <a href="http://www.blogdamned.com/">Goupil Acnéique</a></p>
<p>Être tenu au courant des nouveautés <a href="http://feeds.feedburner.com/empilements-incongrus">RSS</a> | <a href="http://feedburner.google.com/fb/a/mailverify?uri=empilements-incongrus&loc=fr_FR">Email</a> | <a href="http://www.facebook.com/empilements">Facebook</a></p>
</div>

</div><!-- .grid_4 -->