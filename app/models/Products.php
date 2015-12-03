<?php

class Products extends Eloquent {

	protected $table = 'products';
	protected $appends = ['gallery', 'category'];
	protected $fillable = ['name', 'slug', 'description', 'price', 'stock', 'gallery_id', 'category_id'];

	public function hasGalleryAttribute() {
        return Gallery::where('id', $this->gallery_id)->get();
    }

    public function getCategoryAttribute($value) {
        return Category::whereId($this->attributes['category_id'])->first();
    }
}
