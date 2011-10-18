<?php $i = 0 ?>
<?php foreach ($compilationsSpec as $name => $spec): ?>
	<?php if ($i % 4 == 0): ?>
<div class="row">
	<?php endif; ?>
	<div class="span4" style="text-align:center;">
		<a href="?c=<?php echo $name?>"><img src="<?php echo sprintf('compilations/%s/thumb.gif', $name)?>" /></a>
	<p><a href="?c=<?php echo $name?>"><?php echo $spec['manifest']['title'] ?></a></p>
	</div>
	<?php $i++ ?>
	<?php if ($i % 4 == 0): ?>
</div>
	<?php endif; ?>
<?php endforeach; ?> 
