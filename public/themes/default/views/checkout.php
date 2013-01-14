<h1>Check this out</h1>

<ul class="items">
<?php foreach(Basket::items() as $item): ?>
	<li>
		<b><?php echo $item->name; ?></b> <?php echo price($item->price); ?>
		
		<a href="<?php echo $base; ?>checkout/remove/<?php echo $item->id; ?>">Nope</a>
	</li>
<?php endforeach; ?>
</ul>

<a href="/checkout/pay">Let's do this shit</a>