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


    public function paginationResult(\Illuminate\Contracts\Pagination\LengthAwarePaginator $paginated): array
    {
        return [
            'current_page'     => $paginated->currentPage(),
            'per_page'         => $paginated->perPage(),
            'total'            => $paginated->total(),
            'last_page'        => $paginated->lastPage(),
            'next_page'        => $paginated->nextPageUrl(),
            'previous_page'    => $paginated->previousPageUrl(),
            'has_next_page'    => $paginated->hasMorePages(),
            'has_previous_page' => $paginated->currentPage() > 1,
        ];
    }
}