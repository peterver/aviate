<form action="" method="post" enctype="multipart/form-data">
	<h1>Add product</h1>
	<button id="save" type="submit">Create product</button>
		
	<div class="main">
		<?php if(isset($msg)) echo '<p class="error">' . $msg . '</p>'; ?>
		
		<div class="split">
			<p><input tabindex="1" autofocus id="name" name="name" value="<?php echo Input::post('name'); ?>" placeholder="Product name"></p>
			
			<p>
				<span class="prepend"><?php echo Config::get('currency'); ?></span>
				<input tabindex="2" id="price" name="price" placeholder="Product price" value="<?php echo Input::post('price'); ?>">
			</p>
		</div>

		<div class="meta">
			<p class="image">
				<label for="img">Product image</label>
				<input type="file" id="img" name="img">
			</p>
			<p>
				<input tabindex="3" id="stock" name="stock" placeholder="Product stock" value="<?php echo Input::post('stock'); ?>">
			</p>
			
			<p>
				<input tabindex="4" class="code" id="slug" name="slug" placeholder="Product slug" value="<?php echo Input::post('stock'); ?>">
			</p>
			
			<p>
				<label for="visible" title="Should people be able to see this?">Published</label>
				<input id="visible" name="visible" type="checkbox" <?php if(Input::post('visible', 'yes') === 'yes') echo 'checked'; ?> value="yes">
			</p>

			<p>
				<span class="prepend">%</span>
				<input tabindex="5" id="discount" name="discount" placeholder="Product discount" value="<?php echo Input::post('discount'); ?>">
			</p>
			
			<p>
				<input tabindex="6" class="code" id="id" name="id" placeholder="Product ID/SKU" value="<?php echo Input::post('id'); ?>">
			</p>
		</div>
		
		<div class="description">
			<p>
				<textarea tabindex="7" name="description" id="description" placeholder="Product description"><?php echo Input::post('description'); ?></textarea>
			</p>
		</div>
	</div>
</form>