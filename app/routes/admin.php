<?php

Route::get(ADMIN_LOCATION . '/login', 'UsersController@getLogin');
Route::post(ADMIN_LOCATION . '/login', 'UsersController@postLogin');

Route::group(array('before' => 'installed|auth'), function() {
	//  Got to be a better way of doing this.
	//  Unfortunately the guy who wrote this at 1am couldn't
	//  think of a better way. Bad guy.
	foreach(array('products', 'categories', 'pages') as $method) {
		Route::controller(ADMIN_LOCATION . '/' . $method, ucfirst($method) . 'Controller');
	}

	Route::get(ADMIN_LOCATION, 'AdminController@getIndex');
	Route::get(ADMIN_LOCATION . '/logout', 'UsersController@getLogout');
});