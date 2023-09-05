<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages():array
    {
        return [
            'email' => 'Must be Email type',
            'unique' => 'This email is not unique',
            'string' => 'Must be string',
            'max' => 'Max count - :max',
        ];
    }
}
