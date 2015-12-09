<?php

/*
 *   aviate - Page functions
 *
 *   Here's where all the stock functions for Aviate live.
 *   These functions only work when in the context of a
 *   page and handle everything to do with getting our
 *   page content and metadata aliased easily.
 */


/*
 *   current_theme()
 *
 *   Return the folder name of the current theme as a string.
 */
function current_theme() {
	return Theme::current();
}

/*
 *   theme_url([string $suffix])
 *
 *   Return a full relative URL to anything from within your
 *   theme. If there's nothing given for $suffix it'll just
 *   return the path to your theme.
 */
function theme_url($suffix = '') {
	return Theme::url() . ltrim($suffix, '/');
}

/*
 *   theme_path([string $suffix])
 *
 *   Return the PHP include path, relative to the theme.
 *   Don't publibly display this as it'll reveal some
 *   potentially sensitive information about your site.
 */
function theme_path($what = '') {
	return public_path() . theme_url($what);
}

/*
 *   asset_url(string $file, [boolean $return_file_type])
 *
 *   Get the URL and folder for an asset, assuming a folder
 *   is structured like so:
 *
 *   assets/
 *    |- img/
 *       |- *.png, *.jpg, *.gif, *.bmp, *.svg
 *    |- css/
 *       |- *.css
 *    |- js/
 *       |- *.js
 *
 *   This function does not do any Rails-style smart searching.
 *   If you've got files outside of this path the URLs generated
 *   won't work.
 */
function asset_url($file, $returnType = false) {
	$type = pathinfo($file, PATHINFO_EXTENSION);

	//  Set image type if we're using a weird image
	if(in_array($type, ['png', 'jpg', 'gif', 'bmp', 'svg'])) {
		$type = 'img';
	}

	$path = theme_url('assets/' . $type . '/' . $file);

	if($returnType === true) {
		return ['url' => $path, 'type' => $type];
	}

	return $path;
}

/*
 *   theme_asset(string $file)
 *
 *   Take a file name, generate the location and
 *   generate a matching HTML string to include the file.
 *
 *   Example:
 *   {{ theme_asset('style.css') }}
 *    -> '<link rel="stylesheet" href="/assets/css/style.css">'
 */
function theme_asset($file) {
	//  Allow calling as an array
	//  {{ theme_asset(['test.jpg', 'lol.css']) }}
	if(is_array($file)) {
		foreach($file as $item) {
			theme_asset($item);
		}

		return;
	}

	//  Store an array of file types so we know what we're
	//  going to be comparing against. HTML::{type} gets called.
	$types = ['js' => 'script', 'css' => 'style', 'img' => 'image'];

	//  Get our URL and file type to match $types
	$info = asset_url($file, true);

	//  Get our arguments and replace the first one with the right URL
	$args = func_get_args();
	$args[0] = $info['url'];

	//  Call HTML::{$type} with our arguments
	return call_user_func_array('HTML::' . $types[$info['type']], $args);
}

/*
 *   Alias of theme_asset()
 */
function assets() {
	return call_user_func_array('theme_asset', func_get_args());
}

/*
 *   Shorthand to keep with common conventions
 */
function stylesheet() {
	return theme_asset('style.css');
}

//  Extend Blade to allow defining a PHP
//  block (or any code).
Blade::extend(function($value) {
	return preg_replace('/\@define(.+)/', '<?php ${1}; ?>', $value);
});