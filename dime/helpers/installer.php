<?php defined('IN_APP') or die('Get out of here');

class Installer {
	public static function requirements() {
		$checks = array(
			//  Make sure we have a decent version of PHP to run Scaffold on
			'php_version' => !!version_compare(phpversion(), '5.3.2'),
			
			//  And make sure mod_rewrite is enabled for pretty URLs
			'mod_rewrite' => in_array('mod_rewrite', apache_get_modules())
		);
		
		foreach($checks as $name => $check) {
			if($check === false) {
				echo $check;
			}
		}
	}
}

//  This 
if(!Installer::requirements()) {
	die('your server sucks bro');
}