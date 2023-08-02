<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {

        return [
                'name' => [
                    'required',
                    Rule::unique('categories')->ignore($this->category),
                    'regex:/[a-zA-Z0-9\s]+/'
                ]];
        
    }
    public function messages(): array
{
    return [
        'name' =>'category Already exists'
    ];
}
}
