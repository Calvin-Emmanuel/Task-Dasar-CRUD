<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserPosts extends Model
{
    protected $table = 'userposts';

    protected $fillable = [
        'title', 
        'description',
        'image_path',
        'category_id',
        'image_path'
    ];

    public function category(){
            return $this->belongsTo(PostCategory::class, 'category_id');
    }
}
