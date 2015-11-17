<?php

//  Install step 1.
//  Get the database set up.
Route::get('install', ['before' => 'hasDB', 'uses' => 'InstallController@showWelcome']);
Route::post('install', ['before' => 'hasDB', 'uses' => 'InstallController@doWelcome']);

Route::get('install/meta', ['before' => 'installing', 'uses' => 'InstallController@showMeta']);
Route::post('install/meta', ['before' => 'installing', 'uses' => 'InstallController@doMeta']);

Route::get('install/done', ['before' => 'installing', 'uses' => 'InstallController@showDone']);