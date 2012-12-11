<?php defined('IN_APP') or die('Get out of here');

class Pages {
	public static function visible() {
		$objects = Storage::get('objects');
		$db = $objects['database'];
		
		$pages = $db->select('*')->from('pages')->where(array('in_nav' => 1))->fetch();
		$return = array();
		
		foreach($pages as $id => $page) {
			$page->active = Url::segment(1) === $page->slug;
			
			$return[$id] = $page;
		}
		
		return $return;
	}
}