<?php !defined('IN_APP') and header('location: /');

class Storage {
	private $data;
	private static $instance;
	
	public static function get($what, $fallback = '') {
		return self::instance()->_get($what, $fallback);
	}
	
	public static function set($what, $value) {
		return self::instance()->_set($what, $value);
	}
	
	public static function all() {
		return self::instance()->_all();
	}
	
	//  Create a static instance
	public static function instance() {
		if(!isset(self::$instance)) {
			self::$instance = new self();
		}
		
		return self::$instance;
	}

	//  Grab an item from the data
	private function _get($what, $fallback) {
		$what = explode('.', $what);
		$target = $this->data;
		
		foreach($what as $wat) {
			if(isset($target[$wat])) {
				$target = $target[$wat];
			}
		}
		
		if($target !== $this->data) return $target;
		
		return $fallback;
	}
	
	private function _set($what, $value) {
		return $this->data[$what] = $value;
	}
	
	private function _all() {
		return $this->data;
	}
}