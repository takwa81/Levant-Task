<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Traits\ResultTrait;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use ResultTrait;

    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(Request $request)
    {
        try {
            $posts = $this->postService->getAll($request->get('search'));
            return $this->successResponse($posts, __('messages.posts.list_success'));
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }

    public function store(PostRequest $request)
    {
        try {
            $post = $this->postService->create($request->validated());
            return $this->successResponse($post, __('messages.posts.created'));
        } catch (\Exception $e) {
            return $this->errorResponse(__('messages.unexpected_error'), ['error' => $e->getMessage()]);
        }
    }

    public function update(PostRequest $request, $id)
    {
        try {
            $post = $this->postService->update($id, $request->validated());
            return $this->successResponse($post, __('messages.posts.updated'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), [], 403);
        }
    }

    public function destroy($id)
    {
        try {
            $this->postService->delete($id);
            return $this->successResponse(null, __('messages.posts.deleted'));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), [], 403);
        }
    }
}