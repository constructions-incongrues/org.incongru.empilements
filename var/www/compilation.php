<hr />

<h2 name="eventail"><a href=""><?php echo $infos['title']?></a></h2>
<p class="links">⇃ <a href="download.php?c=<?php echo $compilation ?>">Télécharger</a> ⇂</p>
<h3>À Propos</h3>
<ul>
	<li>Date : <?php echo $infos['date'] ?></li>
	<li>Selectors : <?php echo $infos['authors'] ?></li>
</ul>
<h3>Contenu</h3>
<p><img style="float:right;" src="<?php echo $compilation ?>/logo.png" /></p>
<ol>
<?php foreach ($tracks as $track): ?>
	<li><a href="<?php echo sprintf('%s/tracks/%s', $compilation, basename($track)) ?>"><?php echo preg_replace('/^\d\d - (.*)$/', '${1}', basename($track, '.mp3')) ?></a></li>
<?php endforeach; ?>
</ol>
