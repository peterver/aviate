<?php

Route::get('admin/login', 'UsersController@getLogin');
Route::post('admin/login', 'UsersController@postLogin');

Route::group(array('before' => 'installed|auth'), function() {
	//  Got to be a better way of doing this.
	//  Unfortunately the guy who wrote this at 1am couldn't
	//  think of a better way. Bad guy.
	foreach(array('products', 'categories', 'pages') as $method) {
		Route::controller('admin/' . $method, ucfirst($method) . 'Controller');
	}

	Route::get('admin', 'AdminController@getIndex');
	Route::get('admin/logout', 'UsersController@getLogout');
});