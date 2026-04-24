<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurant';
    protected $primaryKey = 'restaurant_id';
    public $timestamps = false;

    protected $fillable = [
        'restaurant_name', 'restaurant_phone', 'foodtype', 'restaurant_location',
        'restaurant_content', 'restaurant_image', 'restaurant_image2',
        'restaurant_image3', 'restaurant_rating', 'opening_day', 'open_hour', 'close_hour'
    ];
}
