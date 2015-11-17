<?php

function page_content() {
	return Page::getCurrent('content');
}

function page_slug() {
	return Page::getCurrent('slug');
}

function page_title() {
	return Page::getCurrent('title');
}

function is_page_visible() {
	return Page::getCurrent('visible');
}