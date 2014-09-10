<?php

class Basket extends Eloquent {

	protected $table = 'baskets';

	public static function itemCount() {
		return 7;
	}
}
