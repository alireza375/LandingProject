<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Even extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'images',
        'short_description',
        'date',
    ];
}
