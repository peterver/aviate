<?php

class Metadata extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'metadata';

	public static function format() {
		$all = self::all();
		$filtered = array();

		foreach($all as $row) {
			$filtered[$row->key] = $row->value;
		}

		return (object) $filtered;
	}
}
