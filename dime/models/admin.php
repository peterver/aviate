<?php defined('IN_APP') or die('Get out of here');

class Admin_model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function findUser($username, $password) {
		return first($this->db->select('*')->from('users')->where(array(
			'username' => $username,
			'password' => $password
		))->fetch());
	}
}