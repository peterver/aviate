<?php

/**
 *   Adding a contact form to dime in less than 20 lines of code.
 *   Seriously.
 */

//  Set up the form
$form = file_get_contents(APP_BASE . 'plugins/contact/form.html');

//  Store POST values as variables
$form = preg_replace_callback('/(\{([a-zA-Z]+)\})/', function($matches) {
	return Input::post($matches[2]);
}, $form);

//  Handle errors
$fields = array('name', 'email', 'message');
$error = '';
if(Input::posted()) {
	foreach($fields as $field) {
		if(Input::post($field) == '') $error[] = $field;
	}
	
	if(count($error) > 0) $form = '<p class="error">Required fields: ' . join(', ', $error) . '.</p>' . $form;
}

Plugin::bind('static', function($data) use($form) {
	//  Only add to the "contact" page
	if($data->slug === 'contact') {
		//  Append the form
		$data->content .= $form;
	}
});

Plugin::page('contact', 'Whats your email bro');