<div class="row">
	<div class="span16">
		<hr />
		<h2 name="eventail">
			<a href=""><?php echo $infos['title']?>
			</a>
		</h2>
		<p class="links">
			⇃ <a href="download.php?c=<?php echo $compilation ?>">Télécharger</a> ⇂
		</p>
	</div>
</div>
<div class="row">
	<div class="span16">
		<h3>À Propos</h3>
		<ul>
			<li>Date : <?php echo $infos['date'] ?>
			</li>
			<li>Selectors : <?php echo $infos['authors'] ?>
			</li>
		</ul>
	</div>
</div>
<div class="row">
	<div class="span8">
		<h3>Contenu</h3>
		<ol>
<?php foreach ($tracks as $track): ?>
			<li>
				<a href="<?php echo sprintf('compilations/%s/tracks/%s', $compilation, basename($track)) ?>"><?php echo preg_replace('/^\d\d - (.*)$/', '${1}', basename($track, '.mp3')) ?></a>
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