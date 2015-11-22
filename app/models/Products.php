<?php

class Products extends Eloquent {

	protected $table = 'products';
	protected $appends = ['gallery'];
	protected $fillable = ['name', 'slug', 'description', 'price', 'stock', 'gallery_id', 'category_id'];

	public function hasGalleryAttribute() {
        return Gallery::where('id', $this->gallery_id)->get();
    }
}
