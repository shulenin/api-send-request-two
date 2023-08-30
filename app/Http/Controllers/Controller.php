<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Swagger(
 *      schemes={"http"},
 *      host="api-send-request",
 *      basePath="/api/v1",
 *      @OA\Info(
 *          title="API Send Request",
 *          version="1.0.0"
 *      ),
 *      @OA\SecurityScheme(
 *          type="apiKey",
 *          in="header",
 *          securityScheme="api_key",
 *          name="Authorization"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
