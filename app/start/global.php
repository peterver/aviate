<?php

/*
|--------------------------------------------------------------------------
| Set Aviate's current version
|--------------------------------------------------------------------------
|
| We'll use this to compare with the latest distributed version on Github.
| This can be accessed by calling `AVIATE_VERSION` or Metadata::version().
|
*/
define('AVIATE_VERSION', '0.1.0');

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(
	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
	app_path().'/plugins',
));

/*
|--------------------------------------------------------------------------
| Plugin registering
|--------------------------------------------------------------------------
|
| We want to add class support to any more complex classes with a subfolder
| structure, so we'll load in the directory /plugins as well as scanning
| the direct folder.
|
*/

$dirs = File::directories(app_path() . '/plugins');

ClassLoader::addDirectories($dirs);

foreach($dirs as $dir) {
	$functions = $dir . '/functions.php';

	if(File::exists($functions)) {
		include_once $functions;
	}
}

View::addNamespace('plugin', 'app/plugins');
View::addLocation(app_path() . '/plugins/');


/*
|--------------------------------------------------------------------------
| Theme functions
|--------------------------------------------------------------------------
|
| Built on top of Laravel is our custom theme functions, we need to make
| sure they're all loaded so there's no errors
|
*/
$functions = array('metadata', 'theme', 'page', 'product', 'basket');

foreach($functions as $function) {
	require app_path() . '/functions/' . $function . '.php';
}

View::addNamespace('theme', public_path() . '/themes/' . Metadata::item('theme', 'default'));
View::addLocation(theme_path('layouts'));
View::addLocation(theme_path('partials'));


/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';