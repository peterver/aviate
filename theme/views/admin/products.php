<h1>All products</h1>

<ul class="products">
	<?php foreach($products as $product): ?>
		<li class="<?php echo $product->oos ? 'oos' : ''; ?>">
			<a href="/admin/products/<?php echo $product->id; ?>">
				<span class="title"><?php echo $product->name; ?></span>
				
				<?php foreach($product->tags as $tag): ?>
					<span class="tag"><?php echo $tag; ?></span>
				<?php endforeach; ?>
				
				<span class="price"><?php echo Config::get('currency') . $product->price; ?></span>
			</a>
		</li>
	<?php endforeach; ?>
</ul>