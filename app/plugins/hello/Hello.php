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
		Event::listen('admin.welcome_message', function($msg) {
		    return $this->lines[array_rand($this->lines)];
		});
	}
}