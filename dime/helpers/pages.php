<?php defined('IN_APP') or die('Get out of here');

class Pages {
	public static function visible() {
		$db = Storage::get('objects.database');
		
		$pages = $db->select('*')->from('pages')->where(array('in_nav' => 1))->fetch();
		$return = array();
		
		foreach($pages as $id => $page) {
			$page->active = self::isActive($page->slug);
			
			$return[$id] = $page;
		}
		
		return $return;
	}
	
	public static function isActive($slug) {
		return $slug === Url::segment(1);
	}
}