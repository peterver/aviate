<?php

class InstallController extends Controller {

	public function doWelcome() {
		$error = false;

		//  Get our DB info
		$fields = Input::except('_token');

		//  Get our config file
		$file = File::get('app/storage/meta/database.php');
		
		//  Replace all the variables with our user input
		foreach($fields as $key => $field) {
			$file = str_replace('$' . $key, $field, $file);
		}

		//  And save it to the config file
		$src = 'app/config/database.php';
		
		if(!File::put($src, $file)) {
			$error = 'Could not save to <code>' . $src . '</code>. Please check your file permissions.';
		}

		if($error) {
			View::share('error', $error);
		}

		return self::showWelcome();
	}

	public function showWelcome() {
		return View::make('install/welcome')->with(array(
			'databases' => array(
				'mysql' => 'MySQL',
				'sqlite' => 'SQLite',
				'pgsql' => 'Postgres',
				'sqlsrv' => 'SQLSRV'
			)
		));
	}

	public function doMeta() {
		$error = false;

		//  Set our metadata
		Metadata::set(Input::except(['user', 'pass', '_token']));

		//  Check the Stripe API key is valid
		try {
			Stripe::setApiKey(Metadata::item('stripe_key'));
			Stripe\Balance::retrieve();
		} catch(Exception $e) {
			$error = 'That Stripe key doesn’t look valid!';
		}

		//  Create the user
		if(User::whereEmail(Input::get('user'))->exists()) {
			$error = 'Somebody’s already signed up with that email address!';
		} else {
			User::create([
				'email' => Input::get('user'),
				'password' => Input::get('pass'),
				'level' => User::level('admin')
			]);
		}

		if($error === false) {
			return Redirect::to('install/done');
		}
		
		View::share('error', $error);

		return self::showMeta();
	}

	public function showMeta() {
		self::migrate();

		return View::make('install/meta');
	}

	public function showDone() {
		Metadata::set('installed', true);

		return View::make('install/done');
	}

	protected static function migrate() {
		Artisan::call('migrate', ['--force' => true]);
		Artisan::call('db:seed');
	}

}
