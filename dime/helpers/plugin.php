<?php defined('IN_APP') or die('Get out of here');

/**
 *   Dime
 *   Plugin engine
 *
 *   For developers, there's only two methods you need to use:
 *   
 */
class Plugin {
	public static $methods = array();
	public static $pages = array();
	public static $hooks = array();
	
	public static function init() {
		//  Get the plugins from the database
		$plugins = explode(',', Config::get('plugins'));
		
		//  Loop all the available plugins
		foreach($plugins as $plugin) {
			$dir = APP_BASE . 'plugins/' . $plugin . '/';
			$path = $dir . 'about.json';
			
			if(file_exists($path)) {
				$json = json_decode(file_get_contents($path));
				
				if(isset($json->file) and file_exists($dir . $json->file)) {
					include_once $dir . $json->file;
				}
			}
		}
	}
	
	//  This is mostly used in the backend of Dime
	//  but you can use it anywhere
	//  Plugin::receive('my_hook'[, $data]);
	public static function receive($hook, $data = false) {
		//  Add the hook to the list
		self::$hooks[] = $hook;
		
		//  Allow the modification of data through a method
		if(isset(self::$methods[$hook])) {
			return call_user_func(self::$methods[$hook], $data);
		}
		
		//  Or just give back the old data if there isn't
		return $data;
	}
	
	//  Attach to a named hook
	//  Plugin::bind('my_hook', function($data) {
	//      return $data;
	//  });
	// 
	//  Plugin::bind('my_hook my_other_hook', function() {});
	public static function bind($hook, $fn) {
		//  Convert to an array
		if(strpos($hook, ' ') !== false) $hook = explode(' ', $hook);
		
		//  Handle array usage
		if(is_array($hook)) {
			//  Loop every array method, assuming it's a string
			foreach($hook as $method) {
				//  Then bind it as normal
				self::$bind($hook, $fn);
			}
			
			//  Don't let it bind, otherwise we'll get errors
			return;
		}
		
		if(is_callable($fn)) {
			self::$methods[$hook] = $fn;
		}
	}
	
	//  Remove a bound hook
	public static function unbind($hook) {
		unset(self::$methods[$hook]);
	}
	
	//  List all hooks
	//  self::hooks() => array('hook', 'name');
	//  Since the binds come first, this is usually empty from
	//  within a hook. You'll need to do it post-plugin
	//  instantiation.
	//  Since no errors will be generated
	public static function hooks($hook = false) {
		//  Filter down
		if($hook !== false and isset(self::$hooks[$hook])) {
			return self::$hooks[$hook];
		}
		
		return self::$hooks;
	}
	
	//  Add a custom page to the admin panel
	//  Plugin::page('slug', function() {
	//      return 'data you want in that page';
	//  });
	//  
	//  or Plugin::page('slug', 'data you want in that page');
	public static function page($slug, $data) {
		self::$pages[$slug] = $data;
	}
	
	//  Semi-private use
	//  Plugin::pages() => ['a', 'list', 'of', 'pages'];
	public static function pages($slug = false) {
		if($slug !== false) {
			if(isset(self::$pages[$slug])) {
				return self::$pages[$slug];
			}
			
			return false;
		}
		
		return self::$pages;
	}
}