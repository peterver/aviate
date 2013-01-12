<form action="" method="post" enctype="multipart/form-data">
	<h1>Add product</h1>
	<button id="save" type="submit">Create product</button>
		
	<div class="main">
		<?php if(isset($msg)) echo '<p class="error">' . $msg . '</p>'; ?>
		
		<div class="split">
			<p><input autofocus id="name" name="name" value="<?php echo Input::post('name'); ?>" placeholder="Product name"></p>
			
			<p>
				<span class="prepend"><?php echo Config::get('currency'); ?></span>
				<input id="price" name="price" placeholder="Product price" value="<?php echo Input::post('price'); ?>">
			</p>
		</div>

		<div class="meta">
			<p class="image">
				<label for="img">Product image</label>
				<input type="file" id="img" name="img">
			</p>
			
			<p>
				<label for="stock">Stock</label>
				<input id="stock" name="stock" placeholder="unlimited" value="<?php echo Input::post('stock'); ?>">
			</p>
			
			<p>
				<label for="slug">Slug</label>
				<input class="code" id="slug" name="slug" placeholder="my-product" value="<?php echo Input::post('slug'); ?>">
			</p>

			<p>
				<label for="discount">Discount</label>
				<span class="prepend">%</span>
				<input id="discount" name="discount" placeholder="0" value="<?php echo Input::post('discount'); ?>">
			</p>
			
			<p>
				<label for="id">SKU/ID</label>
				<input class="code" id="id" name="id" placeholder="ISBN0001010X" value="<?php echo Input::post('id'); ?>">
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
				<textarea name="description" id="description" placeholder="Product description"><?php echo Input::post('description'); ?></textarea>
			</p>
		</div>
	</div>
</form>