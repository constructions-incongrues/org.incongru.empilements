<div class="row">
	<div class="span16">
		<hr />
		<h2 name="eventail">
			<a href=""><?php echo $infos['title']?>
			</a>
		</h2>
		<p class="links">
			<a href="download.php?c=<?php echo $compilation ?>" onClick="javascript: _gaq.push(['_trackPageview', '/downloads/<?php echo $compilation ?>']);">Télécharger</a> ⇃ 
			<a href="" class="play">Écouter</a> ♪
		</p>
	</div>
</div>
<div class="row">
	<div class="span16">
		<p class="links">↽ <a href="index.php">Voir les autres compilations</a></p>
	</div>
</div>
<div class="row">
	<div class="span16">
		<h3>À Propos</h3>
		<ul>
			<li>Date : <?php echo $infos['date'] ?></li>
			<li>Selector(s) : <?php echo $infos['authors'] ?></li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="span8">
		<h3>Contenu</h3>
		<ol>
<?php foreach ($tracks as $track): ?>
			<li>
				<a class="track" href="<?php echo sprintf('compilations/%s/tracks/%s', $compilation, rawurlencode(basename($track))) ?>"><?php echo preg_replace('/^\d\d - (.*)$/', '${1}', basename($track, '.mp3')) ?></a>
			</li>
<?php endforeach; ?>
		</ol>
	</div>
	<div class="span8">
		<p>
			<img class="cover" src="compilations/<?php echo $compilation ?>/cover.gif" />
		</p>
	</div>
</div>
