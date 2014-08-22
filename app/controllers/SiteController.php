<?php

class SiteController extends BaseController {

	protected $layout;

	public function getIndex()
	{
		$this->layout = array('users' => array(), 'theme' => 'current');
		return $this->render('users.list');
	}

	public function homepage() {

		return View::make('theme::layouts.main')->with('site', Metadata::format());
	}
	
	private function render($view) {
		return View::make('admin.' . $view)->with($this->layout);
	}

}
