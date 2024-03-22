<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'short_description',
        'quick_link',
        'support',
        'contact'
    ];


    protected $casts = [
        "quick_link" =>"array",
        "support" =>"array",
        "contact" =>"array"
    ];
}
