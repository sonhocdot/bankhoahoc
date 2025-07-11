<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'display_name',
        'email',
        'phone',
        'password',
        'role',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function posts() {
        return $this->hasMany(Post::class, 'post_author');
    }

    public function coursesAuthored() {
        return $this->hasMany(Course::class, 'id_author');
    }

    public function quizzesAuthored() {
        return $this->hasMany(Quiz::class, 'id_author');
    }

     public function lessonsAuthored() {
        return $this->hasMany(Lesson::class, 'id_author');
    }

    public function pictures() {
        return $this->hasMany(Picture::class, 'id_author');
    }

     public function advices() {
        return $this->hasMany(Advice::class, 'id_user');
    }

    public function invoices() {
        return $this->hasMany(Invoice::class, 'id_user');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'id_user');
    }

     public function quizHistories() {
        return $this->hasMany(QuizHistory::class, 'id_user');
    }

    public function favoriteCourses()
    {
        return $this->belongsToMany(Course::class, 'favorite_courses', 'id_user', 'id_course')
                    ->withTimestamps(); // Nếu bảng favorite_courses có timestamps
    }
}
