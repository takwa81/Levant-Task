<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\Repositories\PostRepository;

class PostService
{
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll($perPage = 10)
    {
        $posts = $this->postRepository->getPostsWithComments($perPage);
        return PostResource::collection($posts);
    }

    public function create(array $data)
    {
        $post = auth()->user()->posts()->create($data);
        return $post;
    }

    public function update($id, array $data)
    {
        $post = $this->postRepository->find($id);

        if ($post->user_id !== auth()->user()->id) {
            throw new \Exception(__('messages.posts.unauthorized'));
        }

        $post->update($data);
        return $post;
    }

    public function delete($id)
    {
        $post = $this->postRepository->find($id);

        if ($post->user_id !== auth()->user()->id) {
            throw new \Exception(__('messages.posts.unauthorized'));
        }

        $post->delete();
    }
}
