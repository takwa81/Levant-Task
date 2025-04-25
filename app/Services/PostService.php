<?php

namespace App\Services;

use App\Events\PostCreated;
use App\Http\Resources\PostResource;
use App\PaginationEnum;
use App\Repositories\PostRepository;
use App\Traits\ImageHandler;
use App\Traits\ResultTrait;

class PostService
{
    use ResultTrait, ImageHandler;
    protected PostRepository $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function getAll(?string $search = null)
    {
        $perPage = PaginationEnum::DefaultCount->value;

        $query = $this->postRepository
            ->with([
                'user:id,name',
                'comments' => function ($query) {
                    $query->whereNull('parent_id')->with([
                        'user:id,name',
                        'replies.user:id,name',
                    ]);
                },
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

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->storeImage($data['image'], 'post_images');
        }

        $post = auth()->user()->posts()->create($data);

        event(new PostCreated($post, auth()->user()));

        return new PostResource($post);
    }

    public function update($id, array $data)
    {
        $post = $this->postRepository->find($id);

        if ($post->user_id !== auth()->user()->id) {
            throw new \Exception(__('messages.posts.unauthorized'));
        }

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $this->updateImage(
                $data['image'],
                $post->image,
                'post_images'
            );
        }
        $post->update($data);
        return new PostResource($post);
    }

    public function delete($id)
    {
        $post = $this->postRepository->find($id);

        if ($post->user_id !== auth()->user()->id) {
            throw new \Exception(__('messages.posts.unauthorized_delete'));
        }

        $post->delete();
    }
}
