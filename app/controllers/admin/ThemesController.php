<?php

class ThemesController extends AdminController {
	public function getIndex() {
		return Redirect::to(admin_path('themes/view/' . Theme::current()));
	}

	public function getView($theme = false) {
		$theme = Theme::info($theme);

		if($theme === false) {
			return Redirect::to(admin_path('themes'));
		}

		return View::make('admin/themes/preview')->with([
			'theme' => $theme,
			'themes' => Theme::available()
		]);
	}

	public function getPreview($theme = false) {
		return Theme::set($theme)->render('index');
	}
}