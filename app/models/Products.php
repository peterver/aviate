<?php

class Products extends Eloquent {

	protected $table = 'products';

	protected $fillable = ['name', 'slug', 'description', 'price', 'stock', 'gallery_id', 'category_id'];
}
