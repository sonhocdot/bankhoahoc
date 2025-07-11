<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LessonRelationship extends Model
{
    use HasFactory;
    

    public $timestamps = false;
    // public $incrementing = false;

    protected $fillable = [
        'id_course',
        'id_lesson',
    ];

     public function course() {
         return $this->belongsTo(Course::class, 'id_course');
    }

     public function lesson() {
         return $this->belongsTo(Lesson::class, 'id_lesson');
    }
}
