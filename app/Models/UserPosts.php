<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UserPosts extends Model
{
    protected $table = 'userposts';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_path',
        'category_id',
        'image_path'
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, $userId = null)
    {
        $userId = $userId ?: auth()->id();
        return $query->where('user_id', $userId);
    }
}
