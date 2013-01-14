<h1><?php echo $product->name; ?></h1>

<div class="screenshot">
	<?php if($product->image): ?>
		<img src="<?php echo $product->image; ?>" alt="Image for <?php echo $product->name; ?>">
	<?php endif; ?>
</div>

<div class="description">
	<?php echo Markdown($product->description); ?>
	
	<?php echo price($product->price); ?>
</div>

<?php if(Basket::contains($product->id)): ?>
You bought this bro.
<?php else: ?>
<a href="./<?php echo $product->slug; ?>/add">Add to basket</a>
<?php endif; ?>