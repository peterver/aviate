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
		//  Set our metadata
		Metadata::set(Input::except(['user', 'pass', '_token']));

		if(Metadata::item('stripe_key')) {
			
		}

		return self::showMeta();
	}

	public function showMeta() {
		self::migrate();

		return View::make('install/meta');
	}

	protected static function migrate() {
		Artisan::call('migrate', ['--force' => true]);
		Artisan::call('db:seed');
	}

}
