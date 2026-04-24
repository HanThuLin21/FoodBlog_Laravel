<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $table = 'recipe';
    protected $primaryKey = 'recipe_id';
    public $timestamps = false;

    protected $fillable = [
        'recipe_name', 'recipe_category', 'foodtype', 'image1', 'image2', 'image3',
        'recipe_content', 'prep_time', 'cook_time', 'servings', 'instructions'
    ];
}
