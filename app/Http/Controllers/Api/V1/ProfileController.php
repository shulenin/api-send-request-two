<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\RequestCollection;
use App\Http\Resources\UserResource;

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
        return new UserResource(auth()->user());
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
    public function requests(): RequestCollection
    {
        return new RequestCollection(auth()->user()->requests);
    }
}
