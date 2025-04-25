<?php

namespace App\Traits;

trait ResultTrait
{
    public function successResponse($data = null, string $message = '', int $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message ?: __('messages.success'),
            'data' => $data,
        ], $code);
    }

    public function errorResponse(string $message = '', $data = null, int $code = 500)
    {
        return response()->json([
            'success' => false,
            'message' => $message ?: __('messages.error'),
            'data' => $data,
        ], $code);
    }

    public function notFoundResponse(string $message = '')
    {
        return response()->json([
            'success' => false,
            'message' => $message ?: __('messages.not_found'),
            'data' => null,
        ], 404);
    }
}