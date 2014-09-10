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
}
