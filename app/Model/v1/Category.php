<?php

namespace App\Model\v1;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    
    protected static $logAttributes = ['name'];


    protected $table = 'categories';
    public $incrementing = false;
    protected $primaryKey = 'category_id';

    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();
        static::creating(function ($instance) {
            $instance->category_id = str_random(12);
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'category_id' => 'string',
    ];
}
