<form action="" method="post" enctype="multipart/form-data">
	<input autofocus id="name" name="name" value="<?php echo Input::post('name'); ?>" placeholder="Product name">
	<button id="save" type="submit">Create product</button>
	
	<?php if(isset($msg)) echo $msg; ?>
	
	<div class="main">
		<div class="meta">
			<p class="image">
				<label for="img">Product image</label>
				<input type="file" id="img" name="img">
			</p>
			
			<p>
				<label for="price">Product price</label>
				<span class="prepend"><?php echo Config::get('currency'); ?></span>
				<input id="price" name="price" placeholder="20" value="<?php echo Input::post('price'); ?>">
			</p>
			
			<p>
				<label for="stock">Product stock</label>
				<input id="stock" name="stock" placeholder="“unlimited” for an infinite amount" value="<?php echo Input::post('stock'); ?>">
			</p>
			
			<p>
				<label for="slug">Product slug</label>
				<input class="code" id="slug" name="slug" value="<?php echo Input::post('stock'); ?>">
			</p>
			
			<p>
				<label for="visibility">Visible to the public?</label>
				<input id="visibility" name="visibility" type="checkbox" <?php if(Input::post('visibility') === 'yes') echo 'checked'; ?> value="yes">
			</p>

			<p>
				<label for="discount">Discount percentage</label>
				<span class="prepend">%</span>
				<input id="discount" name="discount" placeholder="0" value="<?php echo Input::post('discount'); ?>">
			</p>
			
			<p>
				<label for="id">Product ID</label>
				<input class="code" id="id" name="id" value="<?php echo Input::post('id'); ?>">
			</p>
		</div>
		
		<div class="description">
			<p>
				<textarea name="description" id="description" placeholder="Product description"><?php echo Input::post('description'); ?></textarea>
			</p>
		</div>
	</div>
</form>