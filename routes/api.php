<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\ProfileController;
use App\Http\Controllers\Api\V1\RequestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')
    ->group(function () {
        Route::post('auth/registration', [AuthController::class, 'registration'])
            ->name('auth.registration');
        Route::post('auth/login', [AuthController::class, 'login'])
            ->name('auth.login');

        Route::middleware(['auth:sanctum'])->group(function () {
            Route::post('request/send', [RequestController::class, 'send'])
                ->name('request.send');
            Route::get('profile', [ProfileController::class, 'profile'])
                ->name('profile');
            Route::get('profile/requests', [ProfileController::class, 'requests'])
                ->name('profile.requests');
        });
    });
