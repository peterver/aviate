<header id="top" class="header">
		<a href="<?php echo $base; ?>" id="logo">
			<img src="<?php echo $base; ?>assets/img/dime-logo.png" alt="Dime logo" title="My Dime store">
		</a>
		
		<ul class="nav">
		<?php foreach(Pages::visible() as $page): ?>
			<li class="<?php if($page->active) echo 'active'; ?>">
				<a href="<?php echo $base; ?>static/<?php echo $page->slug; ?>"><?php echo $page->title; ?></a>
			</li>
		<?php endforeach; ?>
		</ul>
		
		<?php if(Basket::hasItems()): ?>
		<p class="basket">
			<a href="<?php echo $base; ?>checkout"><b><?php echo Basket::itemCount(); ?></b> items.</a>
		</p>
		<?php else: ?>
		<p class="basket empty">
			Nothing yet.
		</p>
		<?php endif; ?>
		</p>

		<form id="search" class="right" action="<?php echo $base; ?>search">
			<input id="q" name="q" placeholder="Type and hit enter&hellip;">
			<label for="q"><img src="<?php echo $theme_base; ?>assets/img/search-active.png" alt="Search"></label>
			
			<img src="<?php echo $theme_base; ?>assets/img/search-arrow.png">
		</form>		
	</div>
</header>