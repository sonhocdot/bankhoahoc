<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;
    protected $fillable = [
        'lesson_title',
        'video_id',
        'id_author',
    ];

     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'id_author');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'lesson_relationships', 'id_lesson', 'id_course');
    }
}
