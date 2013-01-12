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
	
	public static function save($key, $value) {
		//  Get the database object
		$db = self::get('objects.database');
		
		//  If the database object exists, store it forever
		if(is_object($db)) {
			//  Remove the old key first
			$db->delete()->from('config')->where(array('key' => $key))->go();
			
			//  Then set the new one
			$a = $db->insert()->into('config')->values(array(
				'key' => $key,
				'value' => $value
			))->go();
		}
	
		return self::set($key, $value);
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