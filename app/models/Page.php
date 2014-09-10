<?php

class Page extends Eloquent {

	protected $table = 'pages';

	public static function visible() {
		$pages = self::where(['visible' => true])->get();

		foreach($pages as $id => $page) {
			if($pages[$id]->slug == Url::current()) {
				$pages[$id]->className = 'class="active"';
			}
		}

		return $pages;
	}
}
