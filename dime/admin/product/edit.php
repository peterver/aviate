<form action="" method="post" enctype="multipart/form-data">
	<h1>Editing “<?php echo $product->name; ?>”</h1>
	<button id="save" type="submit">Save product</button>
		
	<div class="main">
		<?php if($msg) echo '<p class="error">' . $msg . '</p>'; ?>
		
		<div class="split">
			<p><input autofocus id="name" name="name" value="<?php echo Input::post('name', $product->name); ?>" placeholder="Product name"></p>
			
			<p>
				<span class="prepend"><?php echo Config::get('currency'); ?></span>
				<input id="price" name="price" placeholder="Product price" value="<?php echo Input::post('price', $product->price); ?>">
			</p>
		</div>

		<div class="meta">
			<p class="image">
				<label for="img">Product image</label>
				<input type="file" id="img" name="img">
			</p>
			
			<p>
				<label for="stock">Stock</label>
				<input id="stock" name="stock" placeholder="unlimited" value="<?php echo Input::post('stock', $product->stock); ?>">
			</p>
			
			<p>
				<label for="slug">Slug</label>
				<input class="code" id="slug" name="slug" placeholder="my-product" value="<?php echo Input::post('slug', $product->slug); ?>">
			</p>

			<p>
				<label for="discount">Discount</label>
				<span class="prepend">%</span>
				<input id="discount" name="discount" placeholder="0" value="<?php echo Input::post('discount', $product->discount); ?>">
			</p>
			
			<p>
				<label for="id">SKU/ID</label>
				<input class="code" id="id" name="id" placeholder="ISBN0001010X" value="<?php echo Input::post('id', $product->id); ?>">
			</p>
			
			<p>
				<label for="visible" title="Should people be able to see this?">Published</label>
				
				<span class="fancy-tick">
					<input id="visible" name="visible" type="checkbox" <?php if(Input::post('visible', 'yes') === 'yes') echo 'checked'; ?> value="yes">
					
					<span></span>
				</span>
			</p>
		</div>
		
		<div class="description">
			<p>
				<textarea name="description" id="description" placeholder="Product description"><?php echo Input::post('description', $product->description); ?></textarea>
			</p>
		</div>
	</div>
	
	<!--<div class="footer">
		<button id="save" type="submit">Save product</button>
	</div>-->
</form>