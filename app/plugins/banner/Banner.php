<?php

class Banner {
	public function __construct() {
		//  Add our banner slides to the theme/frontend
		if(!Plugin::fired('theme.banner')) {
			Plugin::push('theme.banner', Metadata::json('banner'));
		}
		
		//  Add a backend to manage the slides
		Plugin::listen('admin.nav-actions', 'Banner@adminNav');
		Plugin::listen('admin.pages', 'Banner@adminPage');
	}

	public function adminNav() {
		return 'banner';
	}

	public function adminPage() {
		$input = Input::except('_token');

		if(!empty($input)) {
			Metadata::set('banner', 
				json_encode(array_values($input))
			);
		}

		return array('banner' => 'banner/admin/page');
	}
}