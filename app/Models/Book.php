<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'category',
        'publication_date',
        'isbn',
        'description',
        'status',
    ];

    protected $casts = [
        'publication_date' => 'timestamp'
    ];
}
