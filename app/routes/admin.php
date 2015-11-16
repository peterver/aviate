<?php

Route::get('admin/login', 'AdminController@getLogin');
Route::post('admin/login', 'AdminController@postLogin');

Route::group(array('before' => 'installed|auth'), function() {
	//  Got to be a better way of doing this.
	//  Unfortunately the guy who wrote this at 1am couldn't
	//  think of a better way. Bad guy.
	foreach(array('products', 'categories', 'pages') as $method) {
		$upper = ucfirst($method);

		Route::get('admin/' . $method . '/create', 'AdminController@get' . $upper . 'Create');
		Route::post('admin/' . $method . '/create', 'AdminController@post' . $upper . 'Create');
		
		Route::get('admin/' . $method . '/edit/{id}', 'AdminController@get' . $upper . 'Edit');
		Route::post('admin/' . $method . '/edit/{id}', 'AdminController@post' . $upper . 'Edit');

		Route::delete('admin/' . $method . '/delete/{id}', 'AdminController@deleteProducts');
	}

	Route::controller('admin', 'AdminController');
});