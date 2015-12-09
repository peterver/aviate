<?php

function banners() {
	return Plugin::fire('theme.banner');
}

function list_banners() {
	return Metadata::json('banner');
}