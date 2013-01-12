<ul class="nav">
	<li class="manage">
		<ul>
			<?php foreach(array('products', 'pages', 'purchases', 'customers', 'coupons') as $page): ?>
			<li class="<?php if($url === $page) echo 'active'; ?>">
				<a href="/admin/<?php echo $page; ?>"><?php echo ucfirst($page); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
	
	<li class="maintain">
		<ul>
			<?php foreach(array('plugins', 'themes', 'users', 'settings') as $page): ?>
			<li class="<?php if($url === $page) echo 'active'; ?>">
				<a href="/admin/<?php echo $page; ?>"><?php echo ucfirst($page); ?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</li>
</ul>

<small class="logout">
	<a href="/admin/logout">Log out</a>
</small>