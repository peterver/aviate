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
		//  If we don't have a database connection
		if(!DB::connection()->getDatabaseName() or !Schema::hasTable(with(new static)->getTable())) {
			return false;
		}

		if($item = self::where('key', '=', $what)->pluck('value')) {
			return $item;
		}

		return $fallback;
	}

	public static function installed() {
		return self::item('installed', false);
	}

	public static function hasDB() {
		if(Config::get('database.default') === 'sqlite' and Config::get('database.connections.sqlite.database') === ':memory:') {
			return false;
		}

		return !!DB::connection()->getDatabaseName();
	}
}
