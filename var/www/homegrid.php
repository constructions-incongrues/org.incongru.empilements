<h3>À l'affiche</h3>

<div class="grid8">
<?php foreach ($compilationsSpec as $name => $spec): ?>
	<?php if ($spec['manifest']['is_enabled'] != true): continue; endif; ?>
	<?php if ($spec['manifest']['is_enabled'] == true && $spec['manifest']['is_featured'] == true): ?>
	<div class="release box featured">
		<a href="?c=<?php echo $name ?>" title="Écouter la compilation"><img src="<?php echo sprintf('compilations/%s/thumb_100_200.gif', $name)?>" /></a>
		<h2 class="contributorcatalog"><?php echo $spec['manifest']['date'] ?> <span class="pink">//</span> <?php echo $spec['manifest']['authors'] ?></h2>
		<h1 class="releasenamecatalog"><?php echo truncate_text($spec['manifest']['title'], 70) ?></h1>
		<p class="cataloglink"><a href="?c=<?php echo $name ?>" title="Écouter la compilation"> écouter</a> ♪  <a href="download.php?c=<?php echo $name ?>" onClick="javascript: _gaq.push(['_trackPageview', '/downloads/<?php echo $name?>']);" title="Télécharger la compilation">télécharger</a> </p>
		<div class="details">
			<p><a href="?c=<?php echo $name ?>" title="Écouter la compilation"><span class="pink">Avec :</span> <?php echo truncate_text(implode(', ', $spec['artists']), 295) ?></a></p>			
		</div>
	</div>
	<?php endif; ?>
<?php endforeach; ?>
</div>

<h3>Toutes les compilations (<?php echo count($compilationsSpec) ?>)</h3>

<div class="grid_8 ">
<?php foreach ($compilationsSpec as $name => $spec): ?>
	<?php if ($spec['manifest']['is_enabled'] != true): continue; endif; ?>
	<div class="release box">
		<a href="?c=<?php echo $name ?>" title="Écouter la compilation"><img src="<?php echo sprintf('compilations/%s/thumb_100_200.gif', $name)?>" /></a>
		<h2 class="contributorcatalog"><?php echo $spec['manifest']['date'] ?> <span class="pink">//</span> <?php echo $spec['manifest']['authors'] ?></h2>
		<h1 class="releasenamecatalog"><?php echo truncate_text($spec['manifest']['title'], 70) ?></h1>
		<p class="cataloglink"><a href="?c=<?php echo $name ?>" title="Écouter la compilation"> écouter</a> ♪  <a href="download.php?c=<?php echo $name ?>" onClick="javascript: _gaq.push(['_trackPageview', '/downloads/<?php echo $name?>']);" title="Télécharger la compilation">télécharger</a> </p>
		<div class="details">
			<p><a href="?c=<?php echo $name ?>" title="Écouter la compilation"><span class="pink">Avec :</span> <?php echo truncate_text(implode(', ', $spec['artists']), 295) ?></a></p>			
		</div>
	</div>
<?php endforeach; ?> 
</div>

