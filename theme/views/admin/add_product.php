<form action="" method="post" enctype="multipart/form-data">
	<input tabindex="1" autofocus id="name" name="name" value="<?php echo Input::post('name'); ?>" placeholder="Product name">
	<button id="save" type="submit">Create product</button>
		
	<div class="main">
		<?php if(isset($msg)) echo '<p class="error">' . $msg . '</p>'; ?>

		<div class="meta">
			<p class="image">
				<label for="img">Product image</label>
				<input type="file" id="img" name="img">
			</p>
			
			<p>
				<label for="price">Product price</label>
				<span class="prepend"><?php echo Config::get('currency'); ?></span>
				<input tabindex="2" id="price" name="price" placeholder="20" value="<?php echo Input::post('price'); ?>">
			</p>
			
			<p>
				<label for="stock">Product stock</label>
				<input tabindex="3" id="stock" name="stock" placeholder="“unlimited” for an infinite amount" value="<?php echo Input::post('stock'); ?>">
			</p>
			
			<p>
				<label for="slug">Product slug</label>
				<input tabindex="4" class="code" id="slug" name="slug" value="<?php echo Input::post('stock'); ?>">
			</p>
			
			<p>
				<label for="visible">Visible to the public?</label>
				<input id="visible" name="visible" type="checkbox" <?php if(Input::post('visible', 'yes') === 'yes') echo 'checked'; ?> value="yes">
			</p>

			<p>
				<label for="discount">Discount percentage</label>
				<span class="prepend">%</span>
				<input tabindex="5" id="discount" name="discount" placeholder="0" value="<?php echo Input::post('discount'); ?>">
			</p>
			
			<p>
				<label for="id">Product ID</label>
				<input tabindex="6" class="code" id="id" name="id" value="<?php echo Input::post('id'); ?>">
			</p>
		</div>
		
		<div class="description">
			<p>
				<textarea tabindex="7" name="description" id="description" placeholder="Product description"><?php echo Input::post('description'); ?></textarea>
			</p>
		</div>
	</div>
</form>