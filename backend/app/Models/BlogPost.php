<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $table = 'blogpost';
    protected $primaryKey = 'post_id';
    public $timestamps = false;

    protected $fillable = [
        'post_title', 'post_category', 'foodtype', 'post_description',
        'post_image', 'post_image2', 'post_date'
    ];
}
