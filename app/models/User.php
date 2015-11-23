<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * We want to make sure the user can fill certain items in.
	 *
	 * @var array
	 */
	protected $fillable = array('email', 'level', 'password', 'username', 'name');

	public static $levels = array(
		0 => 'inactive',
		1 => 'default',
		2 => 'admin'
	);

	public static function parse() {
		$users = self::all();

		foreach($users as $id => $user) {
			$users[$id]->status = self::$levels[$users[$id]->level];
		}

		return $users;
	}

	public function setPasswordAttribute($password) {
		$this->attributes['password'] = Hash::make($password);
	}

	public static function level($slug = false) {
		if($slug === false) {
			return self::$levels[Auth::user()->level];
		}

		return array_search($slug, self::$levels);
	}

	public static function is($level) {
		if(!is_numeric($level)) {
			$level = self::level($level);
		}

		return Auth::user()->level == $level;
	}

	public function setRememberToken($value) {
	    $this->remember_token = $value;
	}

	public function getRememberTokenName() {
	    return 'remember_token';
	}

	public static function editing() {
		return self::whereId(Request::segment(4))->first();
	}
}
