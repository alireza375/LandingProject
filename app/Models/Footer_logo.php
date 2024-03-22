<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer_logo extends Model
{
    use HasFactory;

    protected $fillable = [
        'short_description',
        'logo'
    ];

    protected $casts = [
        "logo" => "array",
    ];
}
