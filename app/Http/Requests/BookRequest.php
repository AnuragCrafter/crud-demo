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
       return [
                'name' => [
                    'required',
                    Rule::unique('books','name','NULL')
                          ->where('user_id',auth()->user()->id)
                          ->ignore($this->book),
                    'regex:/[a-zA-Z0-9\s]+/'
                ],
                'category' => 'required',
            ];
    }

    public function messages(): array
{
    return [
        'name.unique' =>'Book Already exists'
    ];
}
}
