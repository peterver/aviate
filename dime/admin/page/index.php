<h1>
	All pages
	
	<a href="<?php echo $base; ?>admin/pages/add">Add page</a>
</h1>

<ul class="items">
	<?php foreach($pages as $page): ?>
		<li>
			<a href="<?php echo $base; ?>admin/pages/<?php echo $page->id; ?>">
				<span class="title"><?php echo $page->name; ?></span>
				
				<?php foreach($page->tags as $tag): ?>
					<span class="tag"><?php echo $tag; ?></span>
				<?php endforeach; ?>
			</a>
		</li>
	<?php endforeach; ?>
</ul>