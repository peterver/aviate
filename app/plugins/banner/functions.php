<?php

function get_banners() {
	return Plugin::fire('theme.banner')->get();
}

function list_banners() {
	return Metadata::json('banner');
}