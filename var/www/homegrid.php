<div class="row">
<?php $limit = 4 ?>
<?php foreach ($compilationsSpec as $name => $spec): ?>
	<div class="span4">
		<img src="<?php echo sprintf('compilations/%s/thumb_240.gif', $name)?>" />
	<?php echo $spec['manifest']['title'] ?>
	</div>
<?php endforeach; ?> 
</div>