<?php

namespace App\Services;

use App\Models\User;
use App\Services\Common\ServiceResult;
use Illuminate\Support\Facades\Hash;

final class AuthService
{
    public function registration(array $data): ServiceResult
    {
        $data['password'] = Hash::make($data['password']);

        $user = new User();
        $user->fill($data);

        if (! $user->save()) {
            return ServiceResult::createErrorResult('User not be registered.');
        }

        return ServiceResult::createSuccessResult(['message' => 'User has been registered.']);
    }

    public function login(array $data): ServiceResult
    {
        $user = User::query()
            ->byEmail($data['email'])
            ->first();

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
