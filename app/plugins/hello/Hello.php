<?php

class Hello {
	public $lines = array(
		'I can see it in your eyes',
		'I can see it in your smile',
		'Are you somewhere feeling lonely?',
		'Let me start by saying I love you',
		'Is it me you’re looking for?'
	);

	public function __construct() {
		Plugin::listen($this);
	}

	public function admin_welcomeMessage($msg) {
		return $this->lines[array_rand($this->lines)];
	}

	public function admin_login($user) {
		if(!$user->name) {
			$user->name = 'Lionel Richie';
		}

		return $user->save();
	}
}