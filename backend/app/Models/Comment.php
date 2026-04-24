<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';
    protected $primaryKey = 'comment_id';
    public $timestamps = false; // We'll manage created_at if needed or map it

    protected $fillable = [
        'post_id', 'user_id', 'comment_text', 'created_at'
    ];
}
