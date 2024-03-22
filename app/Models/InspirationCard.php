<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InspirationCard extends Model
{
    use HasFactory;
    protected $fillable=[
        'missonName',
        'sort_dec',
        'image',
       
    ];

    protected $casts=[
        'image'=>'array'
    ];
}
