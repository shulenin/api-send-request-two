<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Common\ServiceResult;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function __construct(private UserRepository $userRepository) {}

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

    public function login(array $data): ServiceResult
    {
        $rules = [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'max:255'],
        ];
        $messages = [
            'required' => 'Field is required',
            'email' => 'Must be Email type',
            'string' => 'Must be string',
            'max' => 'Max count - :max',
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return ServiceResult::createErrorResult(
                'Data is incorrect.',
                $validator->errors()->toArray(),
            );
        }

        /** @var User $user */
        $user = $this->userRepository->getByEmail($data['email']);

        if (! $user) {
            return ServiceResult::createErrorResult('Incorrect email');
        }

        if (!Hash::check($data['password'], $user->password)) {
            return ServiceResult::createErrorResult('Incorrect password');
        }

        $token = $user->createToken('authToken')->plainTextToken;

        return ServiceResult::createSuccessResult(['token' => $token]);
    }
}
