<?php defined('IN_APP') or die('Get out of here');

class Main_model extends Model {
	public function __construct() {
		parent::__construct();
	}
	
	public function paged($page) {
		$limit = Config::get('per_page', 15);
		
		return $this->db->select('*')->from('products')->where(array(
			'visible' => 1
		))->fetch(($limit * $page) - $limit . ', ' . $limit * $page, true);
	}
}