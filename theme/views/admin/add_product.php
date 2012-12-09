<form action="" method="post">
	<input id="title" value="<?php Input::post('title'); ?>" placeholder="Product title">
	<button id="save" type="submit">Create product</button>
	
	<div class="main">
		<textarea id="desc" placeholder="Product description"><?php echo Input::post('desc'); ?></textarea>
	</div>
</form>