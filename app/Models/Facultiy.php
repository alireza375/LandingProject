<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facultiy extends Model
{
    use HasFactory;
    protected $fillable=[
        'head',
        'image',
        'title',
        'Faculty_Name'
        
    ];

    protected $casts=[
        "Faculty_Name"=>"array",
        "image"=>"array"
    ];
}
