<?php

class Theme {
	//  We use a view prefix for Laravel
	public static $prefix = 'theme::';

	//  What theme are we currently using?
	public static function current() {
		return Metadata::item('theme', 'default');
	}

	//  Get the path to the 
	public static function url() {
		return join([Config::get('theme.path'), '/themes/', self::current(), '/']);
	}

	public static function render($page, $layout = 'main') {
		return View::make(self::prefer($layout, 'layouts/'))
				   ->nest('content', self::prefer($page));
	}

	public static function not_found($view = array('not_found', 'main')) {
		//  L4 doesn't seem to have a simple way to allow
		//  setting responses as well as outputting a nested
		//  view - so we'll just manually set the 404.
		http_response_code(404);

		return self::render($view, $view);
	}

	public static function prefer($files, $prefix = '') {
		//  Looping backwards through an array
		if(is_array($files)) {
			//  array_reverse is a lot slower, we'll just break
			//  the foreach
			foreach($files as $testFile) {
				if(View::exists(self::$prefix . $prefix . $testFile)) {
					$file = $prefix . $testFile;
					break;
				}
			}

			//  Didn't get a match? Well we'll try the fallback
			//  Hopefully that handles it
			if(!$file) {
				$file = $prefix . end($files);
			}
		} else {
			$file = $prefix . $files;
		}

		return self::$prefix . $file;
	}

	public static function set($location) {
		View::addNamespace('theme', 'public/themes/' . $location);

		return new self;
	}

	public static function info($name) {
		$path = public_path() . '/themes/' . $name . '/metadata.json';

		if(!File::exists($path)) {
			return false;
		}

		return json_decode(File::get($path));
	}

	public static function json($path = '', $key = false) {
		if(!$path) {
			$path = self::current();
		}

		$json = public_path() . '/themes/' . $path . '/metadata.json';

		if(File::exists($json) and $json = json_decode(File::get($json))) {
			if($key) {
				return object_get($json, $key);
			}

			return $json;
		}

		return false;
	}

	public static function available($onlyNames = false) {
		$themes = array();
		$prefix = public_path() . '/themes/';

		foreach(File::directories($prefix) as $theme) {
			if($json = self::json($theme . '/metadata.json')) {
				$themes[str_replace($prefix, '', $theme)] = $json;
			}
		}

		return $themes;
	}
}