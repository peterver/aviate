<header id="top" class="header">
		<a href="/" id="logo">
			<img src="/assets/img/dime-logo.png" alt="Dime logo" title="My Dime store">
		</a>
		
		<ul class="nav">
			<li><a href="/about">About Us</a>
			<li><a href="/blog">Blog</a>
			<li><a href="/contact">Contact Us</a>
		</ul>
		
		<form id="search" class="right" action="/search">
			<input class="col3" type="search" placeholder="Search My Dime Store">
		</form>
		
		<p class="basket right">
			<?php if(Basket::hasItems()): ?>
				You have <b><?php echo Basket::itemCount(); ?></b> items.
			<?php else: ?>
				Haven't found anything you like yet?
			<?php endif; ?>
		</p>
		
		
	</div>
</header>