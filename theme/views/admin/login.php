<form action="" method="post" novalidate>
	<?php if(isset($msg)): ?>
		<p class="error"><?php echo $msg; ?></p>
	<?php endif; ?>
	
	<input type="email" autofocus placeholder="Username or email" id="username" name="username" value="<?php echo Input::post('username'); ?>">
	<label for="username">Username or email:</label>

	<input type="password" placeholder="Password" id="password" name="password">
	<label for="password">Password:</label>

	<button type="submit">Log in</button>
</form>