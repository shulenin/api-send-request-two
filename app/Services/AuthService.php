<?php

namespace App\Services;

use App\Models\User;
use App\Services\Common\ServiceResult;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function registration(array $data): ServiceResult
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ];
        $messages = [
            'email' => 'Must be Email type',
            'unique' => 'This email is not unique',
            'string' => 'Must be string',
            'max' => 'Max count - :max',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return ServiceResult::createErrorResult(
                'Data is incorrect.',
                $validator->errors()->toArray()
            );
        }

        $data['password'] = Hash::make($data['password']);

        $user = new User();
        $user->fill($data);

        if (! $user->save()) {
            return ServiceResult::createErrorResult('User not be registered.');
        }

        return ServiceResult::createSuccessResult('User has been registered.');
    }
}
