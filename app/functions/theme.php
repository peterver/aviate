<?php

function get_current_theme() {
	return Theme::current();
}

function get_theme_url($suffix = '') {
	return Theme::url() . ltrim($suffix, '/');
}

function get_theme_path($what = '') {
	return public_path() . get_theme_url($what);
}

function get_asset_url($file, $returnType = false) {
	$type = pathinfo($file, PATHINFO_EXTENSION);

	//  Set image type if we're using a weird image
	if(in_array($type, ['png', 'jpg', 'gif', 'bmp', 'svg'])) {
		$type = 'img';
	}

	$path = get_theme_url('assets/' . $type . '/' . $file);

	if($returnType === true) {
		return ['url' => $path, 'type' => $type];
	}

	return $path;
}

function get_asset($file) {
	//  Allow calling as an array
	//  {{ get_asset(['test.jpg', 'lol.css']) }}
	if(is_array($file)) {
		foreach($file as $item) {
			get_asset($item);
		}

		return;
	}

	//  Store an array of file types so we know what we're
	//  going to be comparing against. HTML::{type} gets called.
	$types = ['js' => 'script', 'css' => 'style', 'img' => 'image'];

	//  Get our URL and file type to match $types
	$info = get_asset_url($file, true);

	//  Get our arguments and replace the first one with the right URL
	$args = func_get_args();
	$args[0] = $info['url'];

	//  Call HTML::{$type} with our arguments
	return call_user_func_array('HTML::' . $types[$info['type']], $args);
}

/**
 *   Alias of get_asset
 */
function get_assets() {
	return call_user_func_array('get_asset', func_get_args());
}

/**
 *   Shorthand to keep with common conventions
 */
function get_stylesheet() {
	return get_asset('style.css');
}