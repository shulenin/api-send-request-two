<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    public function __construct(private AuthService $service) {}

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
     *          description="Success",
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

        $result = $this->service->registration($data);

        if ($result->isError) {
            return $this->badRequestResponse($result->message, $result->errors);
        }

        return $result->data;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/auth/login",
     *     summary="Login",
     *     tags={"User"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
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
     *               )
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent()
     *     )
     * )
     *
     */
    public function login(Request $request): JsonResponse|array
    {
        $data = $request->only([
            'email',
            'password',
        ]);

        $result = $this->service->login($data);

        if ($result->isError) {
            return $this->badRequestResponse($result->message, $result->errors);
        }

        return response()->json($result->data);
    }
}