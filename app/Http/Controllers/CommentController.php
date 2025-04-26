<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Post;
use App\Services\CommentService;
use App\Traits\ResultTrait;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    use ResultTrait;

    protected CommentService $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index($post_id)
    {
        try {
            $data = $this->commentService->getAll($post_id);

            return $this->successResponse($data, __('messages.comments.list_success'));
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }

    public function store(CommentRequest $request, $post)
    {
        try {
            $comment = $this->commentService->create($post, $request->validated());
            return $this->successResponse(new CommentResource($comment), __('messages.comments.created'), 201);
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }
}
