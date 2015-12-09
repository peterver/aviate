<?php

class Page extends Eloquent {

	protected $table = 'pages';
	protected $fillable = ['title', 'slug', 'content'];

	public static function visible() {
		return self::format(self::whereVisible(true)->get());
	}

	public static function current($stripPages = true) {
		$url = str_replace(URL::to('/'), '', URL::current());

		if($stripPages === true) {
			$url = str_replace('/pages/', '', $url);
		}

		return $url;
	}

	public static function getCurrent($key = false) {
		$page = self::whereSlug(self::current())->first();

		if(isset($page->{$key})) {
			return $page->{$key};
		}

		return false;
	}

	public static function format($pages) {
		foreach($pages as $id => $page) {
			if($pages[$id]->slug == self::current()) {
				$pages[$id]->className = 'class="active"';
			}
		}

		return $pages;
	}
}
