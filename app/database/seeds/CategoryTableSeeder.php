<?php

class CategoryTableSeeder extends Seeder {
	public function run() {
		Category::create([
			'name' => 'Uncategorised',
			'slug' => 'uncategorised',
			'description' => 'All other products.'
		]);
	}
}