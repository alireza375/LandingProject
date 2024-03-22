<?php

namespace App\Http\Request;

use App\Traits\ApiValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class InspirationRequest extends FormRequest
{
    use ApiValidationTrait;
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules():array
    {
        return[
            "head"=> "required|string|max:50",
            "sort_dec"=> "required|string|max:100",
            "heading_tag"=> "required|string|max:30",
            "mvg"=> "required",
               
        ];
    }
}
