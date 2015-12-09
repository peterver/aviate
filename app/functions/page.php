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
 *   page_content()
 *
 *   Get the content for a page and return it as a HTML
 *   string. There's no formatting or rendering.
 */
function page_content() {
	return Page::getCurrent('content');
}

/*
 *   page_markdown()
 *
 *   Take page_content() and render it as if it was a
 *   Markdown document. Returns valid HTML.
 */
function page_markdown() {
	return Markdown::string(page_content());
}

/*
 *   page_slug()
 *
 *   Get the page's slug (/pages/{slug}) and return it
 *   as a string.
 */
function page_slug() {
	return Page::getCurrent('slug');
}

/*
 *   page_title()
 *
 *   Get the current page's title. This does not return
 *   the general site title.
 */
function page_title() {
	return Page::getCurrent('title');
}

/*
 *   is_page_visible() / page_visiblity()
 *
 *   Is the page visible in the front-end? You can use
 *   this to check. Returns a boolean. Both functions
 *   are alises of each other.
 */
function is_page_visible() {
	return !!Page::getCurrent('visible');
}

function page_visiblity() {
	return is_page_visible();
}