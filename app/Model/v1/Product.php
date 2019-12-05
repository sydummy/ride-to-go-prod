<?php

namespace App\Model\v1;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'product_id';
    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($instance) {
            $instance->product_id = str_random(12);
        });
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'product_id' => 'string',
        'available_stock' => 'integer',
        'slug' => 'url'
    ];

    /**
     * Get the phone record associated with the user.
     */
    public function categories()
    {
        return $this->hasOne('App\Model\v1\Category', 'category_id', 'category_id')->select(['name']);
        ;
    }
}