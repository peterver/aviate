<h1>Latest products</h1>

<ul class="products">
	<?php for($i = 0; $i < 15; $i++): ?>
	<li>
		<a href="#">
			<img src="http://localhost:1000/posts/avatars/img/<?php echo rand(1,5); ?>.jpg" width="265" height="<?php echo rand(150, 500); ?>">
			
			<span class="caption">
				<h2>Heading</h2>
				<small class="price">$50</small>
			</span>
		</a>
	</li>
	<?php endfor; ?>
</ul>