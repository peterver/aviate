<h1>Plugins</h1>

<ul class="items">
	<?php foreach($plugins as $plugin): ?>
		<li class="<?php echo ($plugin->active ? 'active' : '') . ' ' . ($plugin->page ? 'page' : 'nopage'); ?>">
			<?php if($plugin->page): ?><a href="<?php echo $base; ?>admin/plugins/<?php echo $plugin->slug; ?>"><?php endif; ?>
				<span class="title"><?php echo $plugin->name; ?> <small>by <?php echo $plugin->author; ?></small></span>
				
				<?php if($plugin->active): ?>
					<span class="tag">Active</span>
				<?php endif; ?>
				<?php if($plugin->page): ?>
					<span class="tag">Has page</span>
				<?php endif; ?>
			<?php if($plugin->page): ?></a><?php endif; ?>
			
			<?php if($plugin->active): ?>
				<a class="btn" href="?disable=<?php echo $plugin->slug; ?>">Disable</a>
			<?php else: ?>
				<a class="btn" href="?enable=<?php echo $plugin->slug; ?>">Enable</a>
			<?php endif; ?>
		</li>
	<?php endforeach; ?>
</ul>

<div class="main">
	<p>You can get more plugins by shouting really loud until a developer makes you one or making one yourself. They’re really easy to do, honest.</p>
</div>