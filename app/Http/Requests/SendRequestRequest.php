<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendRequestRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => 'Field is required',
            'string' => 'Must be string',
            'max' => 'Max count - :max',
        ];
    }
}
