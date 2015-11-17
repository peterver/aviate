<?php

/**
 *   Aviate
 *   Storefront routes
 *
 *   Here's where all the URL schemas for the public-facing part
 *   of your Aviate app live. You can change the first argument for
 *   every route (at your own risk!) but changing the second
 *   argument will probably break things.
 */

Route::get('/', array(
	'before' => 'installed',
	'uses' => 'SiteController@homepage'
));


//  Don't show anything for /pages, there shouldn't be anything.
//  We'll let the user go back to the homepage and have a long
//  hard think about what they're doing.
Route::get('pages', function() {
	return Redirect::to('/');
});

Route::get('pages/{page}', array(
	'before' => 'installed',
	'uses' => 'SiteController@singlePage'
));