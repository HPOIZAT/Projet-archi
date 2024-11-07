<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'reservation_start_date',
        'reservation_end_date',
        'condition',
        'status'
    ];

    protected $casts = [
        'reservation_start_date' => 'timestamp',
        'reservation_end_date' => 'timestamp'
    ];
}
