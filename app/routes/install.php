<?php

//  Install step 1.
//  Get the database set up.
Route::group(array('before' => 'installing'), function() {
	Route::get('install', 'InstallController@showWelcome');
	Route::post('install', 'InstallController@doWelcome');

	Route::get('install/meta', 'InstallController@showMeta');
	Route::post('install/meta', 'InstallController@doMeta');

	Route::get('install/done', 'InstallController@showDone');
});