<?php

namespace App\Http\Requests;

use App\Traits\ApiValidationTrait;
use Illuminate\Foundation\Http\FormRequest;

class FooterRequest extends FormRequest
{

    use ApiValidationTrait ;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'logo' => 'required',
            'quick_link' => 'required',
            'support' => 'required',
            'short_description' => 'required',
            'contact' => 'required',
        ];
    }
}
