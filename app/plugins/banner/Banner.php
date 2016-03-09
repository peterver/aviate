<?php

class Banner {
	public static $metadata = [
		'title' => 'Banner manager',
		'icon' => 'butterfly',
		'author' => [
			'name' => '@idiot',
			'email' => 'iam@visualidiot.com'
		]
	];
	
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
		//  URL => metadata
		return ['banner' => self::$metadata];
	}

	public function adminPage() {
		$input = Input::except('_token');

		if(!empty($input)) {
			Metadata::set('banner', 
				json_encode(array_values($input))
			);
		}

		//  URL => file
		return ['banner' => 'banner/admin/page'];
	}
}