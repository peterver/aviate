<form action="" method="post" novalidate>
	<?php if(isset($msg)): ?>
		<p class="error"><?php echo $msg; ?></p>
	<?php endif; ?>
	
	<p>
		<input type="email" placeholder="Username or email" id="username" name="username" value="<?php echo Input::post('username'); ?>">
		<label for="username">Username or email:</label>
	</p>
	
	<p>
		<input type="password" placeholder="Password" id="password" name="password">
		<label for="password">Password:</label>
	</p>
	
	<p>
		<button type="submit">Log in</button>
	</p>
</form>