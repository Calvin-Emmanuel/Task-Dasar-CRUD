<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PostCategory extends Model
{
    protected $table = 'post_categories';
    protected $fillable = ['name'];
    
    public function userposts(){
        return $this->hasMany(UserPosts::class, 'category_id');
    }
}
