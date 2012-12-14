<h1><?php echo $product->name; ?></h1>

<div class="screenshot">
	<?php if($product->image): ?>
		<img src="<?php echo $product->image; ?>" alt="Image for <?php echo $product->name; ?>">
	<?php endif; ?>
</div>

<div class="description">
	<?php echo Markdown($product->description); ?>
</div>