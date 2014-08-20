<?php

class AdminController extends BaseController {

	protected $layout;

	public function getIndex()
	{
		$this->layout = array('users' => array(), 'theme' => 'current');
		return $this->render('users.list');
	}
	
	private function render($view) {
		return View::make('admin.' . $view)->with($this->layout);
	}

}
