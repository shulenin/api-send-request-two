<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\RequestService;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class RequestController extends Controller
{
    public function __construct(private RequestService $service) {}

    /**
     * @OA\Post(
     *     path="/api/v1/request/send",
     *     summary="Send request",
     *     tags={"Request"},
     *     @OA\RequestBody(
     *       required=true,
     *       @OA\MediaType(
     *           mediaType="application/json",
     *           @OA\Schema(
     *               type="object",
     *               @OA\Property(
     *                  property="title",
     *                  description="Title",
     *                  type="string",
     *                  example="Test Title",
     *               ),
     *               @OA\Property(
     *                  property="text",
     *                  description="Text",
     *                  type="string",
     *                  example="Lorem ipsum text",
     *               ),
     *           )
     *       )
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Success",
     *          @OA\JsonContent()
     *     ),
     *     security={
     *          {"api_key": {}}
     *     }
     * )
     *
     */
    public function send(Request $request)
    {
        $data = $request->only([
            'title',
            'text',
        ]);

        $result = $this->service->send($data);

        if ($result->isError) {
            return $this->badRequestResponse($result->message, $result->errors);
        }

        return response()->json($result->data);
    }
}
