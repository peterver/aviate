<?php

class Metadata extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'metadata';
	protected $fillable = ['key', 'value'];
	public $timestamps = false;

	public static function format() {
		$all = self::all();
		$filtered = [];

		foreach($all as $row) {
			$filtered[$row->key] = $row->value;
		}

		return (object) $filtered;
	}

	public static function set($key, $value = false) {
		//  Handle allowing an array to be set
		if(is_array($key)) {
			foreach($key as $index => $item) {
				self::set($index, $item);
			}

			//  Don't let the rest of the function get
			//  called, everything will break.
			return;
		}

		//  Check we've not already got the item,
		//  if not create it.
		$item = self::firstOrCreate(['key' => $key]);

		//  Set the value for our key
		$item->value = $value;

		//  Save and return the metadata key
		return $item->save();
	}

	public static function item($what, $fallback = 'false') {
		if($item = self::where('key', '=', $what)->pluck('value')) {
			return $item;
		}

		return $fallback;
	}

	public static function installed() {
		//  There's got to be a better way of doing this,
		//  all we want to do is get the $this->table variable.
		$table = with(new static)->getTable();

		if(!Schema::hasTable($table)) {
			return false;
		}

		return self::item('installed');
	}
}
