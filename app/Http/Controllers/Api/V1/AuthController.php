<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/v1/auth/registration",
     *     summary="Registration",
     *     tags={"User"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                  property="name",
     *                  description="Name",
     *                  type="string",
     *                  example="John",
     *               ),
     *               @OA\Property(
     *                  property="email",
     *                  description="Email",
     *                  type="string",
     *                  example="test@test.com",
     *               ),
     *               @OA\Property(
     *                  property="password",
     *                  description="Password",
     *                  type="string",
     *                  example="12345678",
     *               ),
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Успешная операция",
     *          @OA\JsonContent()
     *     )
     * )
     *
     */
    public function registration(Request $request)
    {
        $data = $request->only([
            'name',
            'email',
            'password',
        ]);
    }
}