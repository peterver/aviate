<?php defined('IN_APP') or die('Get out of here');

class Installer {
	public static $errors = array();
	public static $checked = false;
	public static $messages = array(
		'php_version' => 'Your PHP version needs to be PHP 5.3.2 or newer. Older versions will <b>not</b> perform correctly or at all.',
		'mod_rewrite' => 'In order to have clean URLs, your server needs to support <code>mod_rewrite</code>. You may need to ask your host about this.',
	);
	
	public static function requirements() {
		if(self::$checked === false) {
			$checks = array(
				//  Make sure we have a decent version of PHP to run Scaffold on
				'php_version' => !!version_compare(phpversion(), '5.3.2'),
				
				//  And make sure mod_rewrite is enabled for pretty URLs
				'mod_rewrite' => in_array('mod_rewrite', apache_get_modules())
			);
			
			
			foreach($checks as $name => $check) {
				if($check === false) self::$errors[] = $name;
			}
		}
		
		return count(self::$errors) === 0;
	}
	
	public static function errors() {
		return self::$errors;
	}
}

//  This 
if(!Installer::requirements()) {
	echo '<h1>Unable to load Dime</h1>';
	echo '<p>In order to use Dime, you need to fulfil some system requirements, which unfortunately, your server does not. Here&rsquo;s what you need to sort out:</p>';
	echo '<ul>';
	foreach(Installer::errors() as $error) {
		echo '<li>' . Installer::$messages[$error] . '</li>';
	}
	echo '</ul>';
	
	echo '<small>P.S: Sorry about the lack of styling. It looks nicer when your server works nicer, honest.</small>';
	
	exit;
}