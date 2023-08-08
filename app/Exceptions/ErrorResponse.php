<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

/**
 * class to return the errors
 */
class ErrorResponse
{
    /**
     * @param Exception $exception
     * @return JsonResponse
     */
    public static function errorResponse(Exception $exception): JsonResponse
    {
        return response()->json([
            "message" => $exception->getMessage(),
        ], $exception->getCode());
    }
}
