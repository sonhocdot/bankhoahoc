<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_post',
        'id_course',
        'id_parent',
        'id_user',
        'content',
        'report_count',
        'rate',
        'show',
    ];

    protected $casts = [
        'show' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'id_post');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'id_course');
    }

    // Relationship đến comment cha
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'id_parent');
    }

    // Relationship đến các comment con (replies)
    public function children()
    {
        return $this->hasMany(Comment::class, 'id_parent');
    }
}
