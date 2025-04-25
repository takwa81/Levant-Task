<?php

namespace App\Services;

use App\Http\Resources\PostResource;
use App\PaginationEnum;
use App\Repositories\PostRepository;
use App\Traits\ResultTrait;

class PostService
{
    use ResultTrait;
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll(?string $search = null)
    {
        $perPage = PaginationEnum::DefaultCount->value;

        $query = $this->postRepository->makeModel()
            ->with([
                'user:id,name',
                'comments.user:id,name',
            ])
            ->latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%$search%")
                    ->orWhere('content', 'LIKE', "%$search%");
            });
        }

        $posts = $query->paginate($perPage);


        return [
            'posts' => PostResource::collection($posts)->response()->getData(true)['data'],
            'pagination' => $this->paginationResult($posts),
        ];
    }

    public function create(array $data)
    {
        $post = auth()->user()->posts()->create($data);
        return new PostResource($post);
    }

    public function update($id, array $data)
    {
        $post = $this->postRepository->find($id);

        if ($post->user_id !== auth()->user()->id) {
            throw new \Exception(__('messages.posts.unauthorized'));
        }

        $post->update($data);
        return new PostResource($post);
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