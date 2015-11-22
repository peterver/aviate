<?php

class Plugin {
	public $data;

	public static $dir = '';
	public static $loaded = array();

	public static function find() {
		self::$dir = app_path() . '/plugins/';

		$plugins = array_merge(File::directories(self::$dir), glob(self::$dir . '*.php'));

		foreach($plugins as $key => $val) {
			$plugins[$key] = self::_strip($val);
		}

		return $plugins;
	}

	public static function init() {
		if(!empty(self::$loaded)) {
			return;
		}

		foreach(self::find() as $plugin) {
			if(class_exists($plugin)) {
				self::$loaded[$plugin] = new $plugin;
			}
		}
	}

	public static function fire($event, $data) {
		//  Load all of our plugins
		self::init();

		$self = new self;
		$self->data = Event::fire('admin.welcome_message', 'Welcome to Aviate!');

		return $self;
	}

	private static function _strip($file) {
		return camel_case(basename(str_replace(self::$dir, '', $file), '.php'));
	}

	public function get() {
		return $this->data;
	}

	public function first() {
		return reset($this->data);
	}

	public function last() {
		return end($this->data);
	}
}