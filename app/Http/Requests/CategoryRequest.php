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

        switch($this->method())
    {
        case 'GET':
        case 'DELETE':
        {
            return [];
        }
        case 'POST':
        {
            return [
                'name' => [
                    'required',
                    'Unique:categories',
                    'regex:/[a-zA-Z0-9\s]+/'
                ]];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [                    
                'name' => [
                    'required',
                    Rule::unique('categories')->ignore($this->category),
                    'regex:/[a-zA-Z0-9\s]+/'
                ]
            ];
        }
        default:break;
    }    
    }
    public function messages(): array
{
    return [];
}
}
