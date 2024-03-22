<?php

namespace App\Http\Request;

use Illuminate\Support\Arr;
use App\Traits\ApiValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest
{

    use ApiValidationTrait;
   
    public function authorize(): bool
    {
        return true;
    }
    public function rules():array
    {
        return[
            "missonName"=> "required",
            "sort_dec"=> "required",
            "image"=> "required",
        ];
    }
}
