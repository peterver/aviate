<?php

/*
 *   aviate - Metadata functions
 *
 *   Here's where all the stock functions for Aviate live.
 *   The metadata functions involve getting miscellaneous
 *   data from the database and config and provide wrappers
 *   for any misc core Laravel methods.   
 */


/*
 *   item(string $key, [$string fallback_value])
 *
 *   Get an item from the Metadata table - or if it doesn't
 *   exist, return an optional fallback value. By default,
 *   this is an empty string.
 */
function item($item, $fallback = '') {
	return Metadata::item($item, $fallback);
}

/*
 *   site_name()
 *
 *   Returns the current site's name as a string, as set
 *   in the admin panel.
 */
function site_name() {
	return item('site_name');
}

/*
 *   site_description([string $fallback])
 *
 *   Get the site's description from the admin panel.
 *   If it's not set, you can use the $fallback argument
 *   to set a return value.
 */
function site_description($fallback = '') {
	return item('site_desc', $fallback);
}

/*
 *   admin_path([string $url])
 *
 *   Generate a relative path to the admin URL from
 *   the site's public path.
 *
 *   $url is optional. If you don't pass it (or pass
 *   an empty string), you'll get the path to the admin
 *   area. If you pass anything it'll get appended.
 */
function admin_path($to = '') {
	return Config::get('admin_location') . '/' . ltrim($to, '/');
}

/*
 *   admin_url([string $url])
 *
 *   Generate an absolute path to the admin URL.
 *
 *   $url is optional. If you don't pass it (or pass
 *   an empty string), you'll get the path to the admin
 *   area. If you pass anything it'll get appended.
 */
function admin_url($to = '') {
	return URL::to(admin_path($to));
}

/*
 *   excerpt(string $string, [int $character_limit = 20, string $suffix, string $word_delimiter])
 *
 *   Shrink a string to a certain amount of words.
 */
function excerpt($string, $limit = 20, $suffix = '&hellip;', $delimiter = ' ') {
	//  Turn our string into an array of words.
	$excerpt = explode($delimiter, trim($string), $limit);

	//  Count up the words
	//  If it doesn't hit the limit, just give the string back
	if(count($excerpt) < $limit) {
		return implode($delimiter, $excerpt);
	}

	//  Otherwise...
	//  Stop the array at the limited amount
	array_pop($excerpt);

	//  And append our suffix to the end.
	return implode($delimiter, $excerpt) . $suffix;
}

/*
 *   fallback($arg, $arg, $arg, ...)
 *
 *   Given a list of as many arguments as needed, this function
 *   will return the first "truthy" one. If none are truthy, it
 *   will just return false.
 *
 *   Example: fallback(false, null, 'I like cats', 'I like dogs')
 *   -> 'I like cats'
 */
function fallback() {
	$args = func_get_args();

	foreach($args as $arg) {
		if(is_array($arg) and !empty($arg)) {
			return $arg;
		}

		if($arg) return $arg;
	}

	//  If there's no truthy arguments, return the last argument
	//  not sure if this is the right thing to do yet.
	//  return false;
	return $args[count($args) - 1];
}

/*
 *   array_squish($array)
 *   
 *   Turn an itemised hash-list of arrays into a merged single-
 *   dimensional array. I think.
 */
function array_squish($array, $squished = []) {
	foreach($array as $item) {
		$key = array_keys($item)[0];
		$row = $item[$key];

		$squished[$key] = $row;
	}

	return $squished;
}