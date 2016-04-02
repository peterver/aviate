<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function() {
	if(Auth::guest()) {
		if(Request::ajax()) {
			return Response::make('Unauthorized', 401);
		}

		return Redirect::guest(Config::get('admin_location') . '/login');
	}
});


Route::filter('auth.basic', function() {
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function() {
	if(Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| Installation filters
|--------------------------------------------------------------------------
|
| We need to check a few installation statuses. So we can do that by adding
| a filter beforehand rather than cluttering up the controllers.
|
*/

Route::filter('installed', function() {	
	if(!Metadata::installed()) {
		if(Metadata::hasDB()) {
			return Redirect::to('install/meta');
		}

		return Redirect::to('install');
	}
});

//  Only use while inside the installer.
Route::filter('installing', function() {
	if(Metadata::installed()) {
		return Redirect::to('/');
	}
});


/*
|--------------------------------------------------------------------------
| First-run filter
|--------------------------------------------------------------------------
|
| When initially creating the admin area, there'll be no products. We don't
| want to add a demo product ideally - as we'd like the user to create
| with real data. So we'll bounce to the first-run screen.
|
*/

Route::filter('firstRun', function() {
	//  For now, we'll manually redirect the user to the "create
	//  new product screen". @TODO: proper first-run process.
	$target = Config::get('admin_location') . '/products/create';

	//  If we're logged in and there's no products, redirect us to fix it.
	if(!Auth::guest() and Products::count() < 1) {
		//  Make sure we're not redirecting to the same page over and over.
		if(!Request::is($target)) {
			return Redirect::to($target)->withError('You need to create a product first!');
		}
	}
});


/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function() {
	if(Session::token() != Input::get('_token')) {
		throw new Illuminate\Session\TokenMismatchException;
	}
});
