<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
                    'Unique:books',
                    'regex:/[a-zA-Z0-9\s]+/'
                ],
                'category' => 'required',
            ];
        }
        case 'PUT':
        case 'PATCH':
        {
            return [                    
                'name' => [
                    'required',
                    Rule::unique('books')->ignore($this->book),
                    'regex:/[a-zA-Z0-9\s]+/'
                ],
                'category' => 'required',
            ];
        }
        default:break;
    } 
    }
}
