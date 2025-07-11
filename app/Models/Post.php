<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'post_author',
        'post_title',
        'post_content',
        'slug',
        'post_image',
        'post_date',
        'comment_count',
        'post_view',
        'description',
        'category',
    ];

    protected $casts = [
        'post_date' => 'datetime',
    ];

    public function author() // Đổi tên relationship
    {
        return $this->belongsTo(User::class, 'post_author');
    }

    public function postCategory() // Đổi tên relationship
    {
        return $this->belongsTo(PostCategory::class, 'category');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_post');
    }
}
