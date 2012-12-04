<header id="top" class="header">
	<div class="wrap">
		<b class="title">
			<a href="/" id="logo">My Dime Store</a>
		</b>
		
		<p class="basket col4 right">
			<?php if(Basket::hasItems()): ?>
				You have <b><?php echo Basket::itemCount(); ?></b> items.
			<?php else: ?>
				Haven't found anything you like yet?
			<?php endif; ?>
		</p>
		
		<form id="search" class="right" action="/search">
			<input class="col3" type="search" placeholder="Search My Dime Store">
		</form>
	</div>
</header>