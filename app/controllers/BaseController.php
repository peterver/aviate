<?php

class BaseController extends Controller {

	public static $currentTheme = 'default';
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		//  Set current theme
		if($theme = Metadata::where('key', 'theme')->pluck('value')) {
			self::$currentTheme = $theme;
		}

		//  Update theme path to match
		$dir = 'themes' . DIRECTORY_SEPARATOR . self::$currentTheme;
		$path = public_path() . DIRECTORY_SEPARATOR . $dir;

		View::addNamespace('theme', $path);

		Config::set('theme.path', $dir);
		Config::set('view.paths', $path);


		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
