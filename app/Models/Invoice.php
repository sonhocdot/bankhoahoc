<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'ho_ten',
        'gia_goc',
        'gia_giam',
        'ghi_chu',
        'trang_thai',
        'email',
        'so_dien_thoai',
        'id_user'
    ];

    protected $casts = [
       'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function courses()
    {
        // Tham số thứ 2 là tên bảng trung gian
        return $this->belongsToMany(Course::class, 'invoice_relationships', 'id_invoice', 'id_course');
    }
}
