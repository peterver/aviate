<header id="top" class="header">
		<a href="/" id="logo">
			<img src="/assets/img/dime-logo.png" alt="Dime logo" title="My Dime store">
		</a>
		
		<ul class="nav">
			<li><a href="/static/about">About Us</a>
			<li><a href="/static/blog">Blog</a>
			<li><a href="/static/contact">Contact Us</a>
		</ul>
		
		<?php if(Basket::hasItems()): ?>
		<p class="basket">
			<a href="/checkout"><b><?php echo Basket::itemCount(); ?></b> items.</a>
		</p>
		<?php else: ?>
		<p class="basket empty">
			Nothing yet.
		</p>
		<?php endif; ?>
		</p>

		<form id="search" class="right" action="/search">
			<input id="q" name="q" placeholder="Type and hit enter&hellip;">
			<label for="q"><img src="/assets/img/search-active.png" alt="Search"></label>
			
			<img src="/assets/img/search-arrow.png">
		</form>		
	</div>
</header>