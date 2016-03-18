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

Route::group(array('before' => 'installed'), function() {
	Route::get('/', 'SiteController@homepage');

	//  Don't show anything for /pages, there shouldn't be anything.
	//  We'll let the user go back to the homepage and have a long
	//  hard think about what they're doing.
	Route::get('pages', function() {
		return Redirect::to('/');
	});
	
	//  Single-page views
	Route::get('pages/{page}', 'SiteController@singlePage');

	//  Basket and checkout views
	Route::get('basket', 'SiteController@basketPage');
	Route::get('basket/empty', 'SiteController@basketEmpty');
	Route::get('basket/update/{product_id}', 'SiteController@basketUpdate');

	//  Listen to our category routes
	//  We need to make sure the category exists and has products
	//  before we display a list.
	Route::get('{category}', 'SiteController@categoryPage');

	//  Single product view
	//  @TODO: make this more configurable
	Route::get('{category}/{product}', 'SiteController@productPage');
	Route::post('{category}/{product}', 'SiteController@buyProduct');

	//  Handle checkout and Stripe interactions
	Route::controller('checkout', 'CheckoutController');
});


//  Listen to any 404 errors and throw them in our controller
//  We'll handle the headers and call a not_found template.
App::missing(function($exception) {
	$controller = 'SiteController';

	//  We want to show admin errors if we're still inside
	//  the admin area, don't leave to show the site yet.
	if(Request::is(Config::get('admin_location') . '/*', Config::get('admin_location'))) {
        $controller = 'AdminController';
    }

    return App::make($controller)->notFound();
});