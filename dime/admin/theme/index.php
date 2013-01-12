<h1>Themes</h1>

<ul class="theme items">
	<?php foreach($themes as $theme): ?>
		<li class="<?php echo ($theme->active ? 'active' : '') . ' ' . ($theme->page ? 'page' : 'nopage'); ?>">
			<?php if($theme->page): ?><a href="/admin/themes/<?php echo $theme->slug; ?>"><?php endif; ?>
				<span class="title"><?php echo $theme->name; ?> <small>by <?php echo $theme->author; ?></small></span>
				
				<?php if($theme->active): ?>
					<span class="tag">Active</span>
				<?php endif; ?>
				<?php if($theme->page): ?>
					<span class="tag">Has page</span>
				<?php endif; ?>
			<?php if($theme->page): ?></a><?php endif; ?>
			
			<?php if($theme->active): ?>
				<a class="btn" href="?disable=<?php echo $theme->slug; ?>">Disable</a>
			<?php else: ?>
				<a class="btn" href="?enable=<?php echo $theme->slug; ?>">Enable</a>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>

<div class="main">
	<p>You can get more themes by shouting really loud until a developer makes you one or making one yourself. They’re really easy to do, honest.</p>
</div>