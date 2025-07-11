<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_author',
        'name',
        'img',
        'description',
        'content',
        'view_count',
        'slug',
        'gia_goc',
        'gia_giam',
        'category',
        'average_rate',
    ];

     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'id_author');
    }

    public function courseCategory() // Đổi tên để tránh trùng với cột 'category'
    {
        return $this->belongsTo(CourseCategory::class, 'category');
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class, 'lesson_relationships', 'id_course', 'id_lesson');
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_relationships', 'id_course', 'id_invoice');
    }

     public function favoritedByUsers() // Những user đã thích khóa học này
    {
        return $this->belongsToMany(User::class, 'favorite_courses', 'id_course', 'id_user')
                    ->withTimestamps(); // Nếu bảng favorite_courses có timestamps
    }

     public function comments() {
        return $this->hasMany(Comment::class, 'id_course');
    }

    // Nếu bạn tạo model cho bảng trung gian, có thể dùng hasMany
    // public function lessonRelationships() {
    //     return $this->hasMany(LessonRelationship::class, 'id_course');
    // }
    // public function invoiceRelationships() {
    //     return $this->hasMany(InvoiceRelationship::class, 'id_course');
    // }
     // public function favoriteCourseEntries() {
    //     return $this->hasMany(FavoriteCourse::class, 'id_course');
    // }
}
