<?php

//  We're using Laravel-Stapler to handle uploading images
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\Stapler;

class Gallery extends Eloquent implements StaplerableInterface {
	use EloquentTrait;

	protected $table = 'gallery';

	protected $fillable = ['image'];

	public function __construct(array $attributes = []) {
        $this->hasAttachedFile('image', [
            'styles' => [
                'medium' => '600x480',
                'thumb' => '256x256',
                'small' => '400x300'
            ],
            
            'default_url' => false
        ]);

        parent::__construct($attributes);
    }

    public static function boot() {
        parent::boot();
        static::bootStapler();
    }
}
