<?php

function get_site_name() {
	return Metadata::item('site_name');
}

function get_site_description($fallback = '') {
	return Metadata::item('site_desc', $fallback);
}