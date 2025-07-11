<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'title',
        'id_author',
        'duration',
        'description',
        'category',
    ];

     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'id_author');
    }

    public function courseCategory() // Đổi tên để tránh trùng
    {
        return $this->belongsTo(CourseCategory::class, 'category');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'id_quiz');
    }

    public function histories()
    {
        return $this->hasMany(QuizHistory::class, 'id_quiz');
    }
}
