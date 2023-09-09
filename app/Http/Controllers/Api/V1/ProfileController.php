<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestsCollection;
use App\Http\Resources\UserResource;
use App\Models\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/profile",
     *     summary="Get user profile data",
     *     tags={"Profile"},
     *     @OA\Response(
     *          response=200,
     *          description="Успешная операция",
     *          @OA\JsonContent()
     *     ),
     *     security={
     *          {"api_key": {}}
     *     }
     * )
     *
     */
    public function profile(): UserResource
    {
        return new UserResource(User::where('id', auth()->id())->first());
    }

    /**
     * @OA\Get(
     *     path="/api/v1/profile/requests",
     *     summary="Get user request list",
     *     tags={"Profile"},
     *     @OA\Response(
     *          response=200,
     *          description="Успешная операция",
     *          @OA\JsonContent()
     *     ),
     *     security={
     *          {"api_key": {}}
     *     }
     * )
     *
     */
    public function requests(): RequestsCollection
    {
        return new RequestsCollection(Request::where('user_id', auth()->id())->get());
    }
}
