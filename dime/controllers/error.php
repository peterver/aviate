<?php defined('IN_APP') or die('Get out of here');

class Error_controller extends Controller {
	public function __construct() {
		parent::__construct();
	}
	
	public function error_404() {
		//  Set template data
		$this->template->set(array(
			'language' => Config::get('language'),
			'title' => 'Where&rsquo;s my page gone?',
			'heading' => 'Page not found.',
			'route' => $this->routes
		));
		
		echo $this->template->render(404);
	}
}