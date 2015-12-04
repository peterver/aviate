<?php

function get_site_name() {
	return Metadata::item('site_name');
}

function get_site_description($fallback = '') {
	return Metadata::item('site_desc', $fallback);
}

function admin_path($to = '') {
	return Config::get('admin_location') . '/' . ltrim($to, '/');
}

function admin_url($to = '') {
	return URL::to(admin_path($to));
}

function excerpt($string, $limit = 20, $suffix = '&hellip;', $delimiter = ' ') {
	$excerpt = explode($delimiter, trim($string), $limit);

	if(count($excerpt) >= $limit) {
		array_pop($excerpt);
		$excerpt = implode($delimiter, $excerpt) . $suffix;
	} else {
		$excerpt = implode($delimiter, $excerpt);
	}	
	
	return preg_replace('`\[[^\]]*\]`','', $excerpt);
}

function fallback() {
	foreach(func_get_args() as $arg) {
		if($arg) return $arg;
	}

	return false;
}