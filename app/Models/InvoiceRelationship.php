<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceRelationship extends Model
{
    use HasFactory;
    public $timestamps = false;
    // public $incrementing = false;

     protected $fillable = [
        'id_invoice',
        'id_course',
    ];

     public function invoice() {
         return $this->belongsTo(Invoice::class, 'id_invoice');
    }

     public function course() {
         return $this->belongsTo(Course::class, 'id_course');
    }
}
