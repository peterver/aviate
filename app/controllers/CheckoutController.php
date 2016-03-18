<?php

class CheckoutController extends BaseController {
	public function __construct() {
		//  Change our prefix to use the right template
		Theme::$prefix = 'checkout::';
	}

	public function getIndex() {
		return Theme::render('index');
	}
	
	public function getAddress() {

	}

	public function postAddress() {

	}

	public function getPayment() {

	}

	public function postPayment() {

	}
}
