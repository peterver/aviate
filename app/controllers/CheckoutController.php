<?php

class CheckoutController extends BaseController {
	public function __construct() {
		//  Change our prefix to use the right template
		Theme::$prefix = 'checkout::';
		
		//  Get our theme's JSON includes as an array
		//  and save it for use later on.
		$includes = Theme::json('include');

		//  Right now we only allow an array of files
		//  (relative to theme root) to include.
		if(is_array($includes)) {
			foreach($includes as $include) {
				$path = theme_path($include);
				
				if(File::exists($path)) {
					include_once $path;
				}
			}
		}
	}
	
	public function getAddress() {

	}

	public function postAddress() {

	}

	public function getPayment() {

	}

	public function postPayment() {

	}
}
