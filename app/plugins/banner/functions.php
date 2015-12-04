<?php

function get_banners() {
	return Plugin::fire('theme.banner')->get();
}