<?php

class Category extends Eloquent {

	protected $table = 'categories';

	protected $fillable = array('name', 'slug', 'description');
	
	public static function current() {
		return self::whereId(Request::segment(4))->first();
	}

	public static function slug($id = false) {
		$result = self::whereId($id)->first();

		if(!$result) {
			return self::slug(1);
		}

		return $result->slug;
	}
}
