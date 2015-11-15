<?php

class SiteController extends BaseController {

	protected $layout;

	public function __construct() {
		View::addNamespace('theme', 'public/themes/' . Metadata::item('theme', 'default'));
	}

	public function getIndex() {
		return View::make('theme::layouts.main')->with(array('site' => Metadata::format()));
	}

	public function homepage() {
		return View::make('theme::layouts.main')->with(array('site' => Metadata::format()));
	}
	
	private function render($view) {
		return View::make('admin.' . $view)->with($this->layout);
	}

}
