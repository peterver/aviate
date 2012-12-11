<?php defined('IN_APP') or die('Get out of here');

class Page_model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function find($page) {
		return $this->db->select('*')->from('pages')->where(array(
			'slug' => $page
		))->fetch();
	}
}