<?php

class Category extends Eloquent {
	protected $table = 'categories';
	protected $fillable = ['name', 'slug', 'description'];

	public static function slug($id = false) {
		$result = self::find($id);

		if(!$result) {
			return self::slug(1);
		}

		return $result->slug;
	}
}
