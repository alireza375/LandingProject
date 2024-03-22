<?php

namespace App\Http\Request;

use App\Traits\ApiValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
             "title"=> "required|string|max:150",
            "short_dec"=> "required|string|max:300"
        ];
    }
}
