<?php

class SiteController extends BaseController {

	protected $layout;
	
	public function homepage() {
		return View::make('theme::index');
	}

	public function singlePage() {
		return View::make('theme::page');
	}

}
