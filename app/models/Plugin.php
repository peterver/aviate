<?php

class Plugin {
	public $data;

	public static $dir = '';
	public static $loaded = array();
	public static $fired = array();

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

				if(!self::fired('init')) {
					self::fire('init');
				}
			}
		}
	}

	public static function listen($event, $callback = false) {
		//  Need a better way of determining if $event is a
		//  class or just a plain object
		if(method_exists($event, '__construct') and $callback === false) {
			//  Get all of our class hooks
			//  Remove magic methods
			$funcs = get_class_methods($event);
			$methods = array_filter($funcs, function($name) {
				return strpos($name, '__') === false;
			});

			//  Loop our class methods
			foreach($methods as $key => $method) {
				//  Wrap our listen method but call statically this time
				self::listen(
					//  Turn namespace_camelCase to our namespace syntax
					self::_process($method),

					//  Generate the original class string that Laravel
					//  listens out for
					get_class($event) . '@' . $funcs[$key]
				);
			}

			//  Don't try to call the rest of the function
			//  we've already done it. Just bail out.
			return;
		}

		return Event::listen($event, $callback);
	}

	public static function push($event, $data) {
		if(!is_array($data)) return;

		foreach($data as $item) {
			$status = Event::listen($event, function() use($item) {
				return $item;
			});
		}

		return $status;
	}

	public static function fire($event, $data = array()) {
		//  Load all of our plugins
		self::init();

		//  Fire the event and store the data for future
		$self = new self;
		$self->data = fallback(Event::fire($event, $data), $data);

		//  Log we've fired the event
		self::$fired[$event] = true;

		return $self->data;
	}

	private static function _strip($file) {
		return camel_case(basename(str_replace(self::$dir, '', $file), '.php'));
	}

	private static function _process($method) {
		$method = explode('_', $method);

		if(isset($method[1])) {
			$method[1] = snake_case($method[1]);
		}

		return join('.', $method);
	}

	public function get($filter = false) {
		if($filter !== false) {
			foreach($this->data as $item) {
				if(isset($item[$filter])) {
					return $item[$filter];
				}
			}

			return false;
		}

		return $this->data;
	}

	public function filter($callback) {
		$this->data = array_filter($this->data, $callback);

		return $this;
	}

	public function first() {
		return reset($this->data);
	}

	public function last() {
		return end($this->data);
	}

	public static function fired($event) {
		return in_array($event, self::$fired);
	}
}