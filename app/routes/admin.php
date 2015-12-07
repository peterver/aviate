<?php

Route::group(array('before' => 'installed'), function() {
	Route::get(Config::get('admin_location') . '/login', 'UsersController@getLogin');
	Route::post(Config::get('admin_location') . '/login', 'UsersController@postLogin');
});

Route::group(array('before' => 'installed|auth'), function() {
	//  Got to be a better way of doing this.
	//  Unfortunately the guy who wrote this at 1am couldn't
	//  think of a better way. Bad guy.
	foreach(array('products', 'categories', 'pages', 'users', 'themes', 'settings') as $method) {
		Route::controller(
			Config::get('admin_location') . '/' . $method,
			ucfirst($method) . 'Controller'
		);
	}

	Route::get(Config::get('admin_location'), 'AdminController@getIndex');
	Route::get(Config::get('admin_location') . '/logout', 'UsersController@getLogout');

	Route::any(Config::get('admin_location') . '/{slug}', 'AdminController@notFound');
});