<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteCourse extends Model
{
    use HasFactory;
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Fillable nếu bạn cần tạo record trực tiếp qua model này
    protected $fillable = [
        'id_user',
        'id_course',
    ];

    // Relationships nếu cần thiết (thường không cần trong model Pivot)
    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function course() {
         return $this->belongsTo(Course::class, 'id_course');
    }
}
