<?php defined('IN_APP') or die('Get out of here');

class Controller {
	public function __construct() {
		foreach(Storage::get('objects') as $name => $class) {
			$this->{$name} = $class;
		}
		
		//  Set the default config from the database
		foreach($this->model->_loadConfig() as $key => $value) {
			Config::set($key, $value);
		}
		
		//  Set some defaults to use our custom theme paths instead of
		//  Scaffold's defaults, make it a bit more discoverable
		$this->template->set(array(
			'view_base' => TEMPLATE_BASE . 'views/',
			'partial_base' => TEMPLATE_BASE . 'partials/'
		));
	}
}