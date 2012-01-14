<div class="grid_8 ">
	<h1 class="contributor">| <?php echo $infos['date'] ?> <span class="pink">//</span> <?php echo $infos['authors'] ?></h1>
	<h2 class="releasename"><?php echo $infos['title']?></h2>
	
	<p class="artwork"><img class="cover" src="compilations/<?php echo $compilation ?>/cover.gif" /></p>
	<ol class="playlist">
<?php foreach ($tracks as $track): ?>
		<li>
			<a class="track" href="<?php echo sprintf('compilations/%s/tracks/%s', $compilation, rawurlencode(basename($track))) ?>"><?php echo preg_replace('/^\d\d - (.*)$/', '${1}', basename($track, '.mp3')) ?></a>
		</li>
<?php endforeach; ?>
	</ol>
</div>