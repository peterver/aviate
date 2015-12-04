<?php

//  We're using Laravel-Stapler to handle uploading images
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\Stapler;

class Products extends Eloquent implements StaplerableInterface {
	use EloquentTrait;

	protected $table = 'products';
	protected $appends = ['gallery', 'category'];
	protected $fillable = ['name', 'slug', 'description', 'price', 'stock', 'gallery_id', 'category_id'];

    public function getCategoryAttribute($value) {
        return Category::whereId(fallback($this->attributes['category_id'], 1))->first();
    }

    public function gallery() {
    	return $this->hasOne('Gallery', 'id', 'gallery_id');
    }
}
