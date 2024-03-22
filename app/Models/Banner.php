<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'navber',
        'logo',
        'title',
        'short_description',
        'image'
    ];


    protected $casts = [
        "image" =>"array",
        "navber" =>"array"
    ];

}
