<?php

namespace App\Http\Request;

use App\Traits\ApiValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class FacultyRequest extends FormRequest
{
    use  ApiValidationTrait;
   
    public function authorize(): bool
    {
        return true;
    }
    public function rules():array
    {
        return[
            "head"=> "required",
            "image"=> "required",
            "title"=> "required",
            "Faculty_Name"=> "required",
        ];
    }
}
