<?php

//  We're using Laravel-Stapler to handle uploading images
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\Stapler;

class Gallery extends Eloquent implements StaplerableInterface {
	use EloquentTrait;

	protected $table = 'gallery';

	protected $fillable = ['image'];

	public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('image', [
            'styles' => [
                'medium' => '600x480',
                'thumb' => '256x256'
            ],
            'default_url' => '/assets/img/default-avatar.png'
        ]);

        parent::__construct($attributes);
    }

    public static function boot() {
        parent::boot();
        static::bootStapler();
    }
}
