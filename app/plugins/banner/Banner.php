<?php

class Banner {
	public function __construct() {
		//  Add our banner slides to the theme/frontend
		Plugin::push('theme.banner', Metadata::json('banner'));
		
		//  Add a backend to manage the slides
		Plugin::listen('admin.nav-actions', 'Banner@adminNav');
		Plugin::listen('admin.pages', 'Banner@adminPage');
	}

	public function adminNav() {
		return 'banner';
	}
}