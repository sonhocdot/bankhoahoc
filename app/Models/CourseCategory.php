<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    use HasFactory;
    public $timestamps = false; // Không có cột created_at/updated_at

    protected $fillable = [
        'name',
        'slug',
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'category');
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class, 'category');
    }
}
