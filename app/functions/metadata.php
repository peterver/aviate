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