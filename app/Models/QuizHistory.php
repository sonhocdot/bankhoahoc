<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizHistory extends Model
{
    use HasFactory;
    public $timestamps = false;
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';


    protected $fillable = [
        'id_quiz',
        'id_user',
        'score',
    ];

     protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function quiz()
    {
        return $this->belongsTo(Quiz::class, 'id_quiz');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
