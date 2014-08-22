<?php

//namespace Helper;

class Theme {

	public static $types = array(
		'css' => '<link rel="stylesheet" href="$1" $3>',
		'js'  => '<script src="$1" $3></script>'
	);

	public static function name() {
		return Metadata::key('theme_name');
	}

	public static function asset($url, $type = '', $attrs = array()) {
		$path = Config::get('theme.path') . DIRECTORY_SEPARATOR;
		
		if($type === '') {
			return asset($path . $url);
		}

		$url = join([$path, 'assets', DIRECTORY_SEPARATOR, $type, DIRECTORY_SEPARATOR, $url, '.', $type]);

		if(isset(self::$types[$type])) {
			if(!empty($attrs)) {
				foreach($attrs as $key => $attr) {
					$attrs[] = $key . '="' . $attr . '"';
					unset($attrs[$key]);
				}
			}

			return str_replace(['$1', '$2', '$3', ' >'], [$url, $type, join(' ', $attrs), '>'], self::$types[$type]);
		}

		return $url;
	}
}