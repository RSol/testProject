<div class="pics"> 
	<?php foreach ($images as $image): ?>
		<img src="<?= $image ?>" width="200" height="200" /> 
	<?php endforeach;?>
</div>

<script>
	$('.pics').cycle({
		fx: '<?= $fx ?>',
		sync: '<?= $sync ?>',
		delay: '<?= $delay ?>'
	});
</script>