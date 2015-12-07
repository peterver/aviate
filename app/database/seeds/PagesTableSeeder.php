<?php

class PagesTableSeeder extends Seeder {
	public function run() {
		Page::create([
			'title' => 'About Us',
			'slug' => 'about',
			'content' => 'We need to write something about us!',
			'visible' => true
		]);
	}
}