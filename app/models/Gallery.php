<?php

//  We're using Laravel-Stapler to handle uploading images
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Gallery extends Eloquent implements StaplerableInterface {
	use EloquentTrait;

	protected $table = 'gallery';

	protected $fillable = ['id', 'image'];

	public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('image', [
            'styles' => [
                'medium' => '600x480',
                'thumb' => '256x256'
            ]
        ]);

        parent::__construct($attributes);
    }
}
