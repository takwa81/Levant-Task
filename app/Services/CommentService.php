<?php

namespace App\Services;

use App\Events\CommentCreated;
use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;
use App\Models\Post;
use App\PaginationEnum;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResultTrait;

class CommentService
{
    use ResultTrait;

    protected $commentRepository;
    protected $postRepository;

    public function __construct(CommentRepository $commentRepository, PostRepository $postRepository)
    {
        $this->commentRepository = $commentRepository;
        $this->postRepository = $postRepository;
    }

    public function create($post_id, array $data)
    {
        $post = $this->postRepository->find($post_id);
        $comment = $this->commentRepository->create([
            'post_id' => $post->id,
            'user_id' => auth()->user()->id,
            'comment' => $data['comment'],
        ]);

        event(new CommentCreated($comment));

        return $comment;
    }

    public function getAll($post_id)
    {
        $post = $this->postRepository->find($post_id);

        $perPage = PaginationEnum::DefaultCount->value;

        $query = $post->comments()
            ->with('user', 'replies.user')
            ->latest();

        $comments = $query->paginate($perPage);

        return [
            'comments' => CommentResource::collection($comments)->response()->getData(true)['data'],
            'pagination' => $this->paginationResult($comments),
        ];
    }

  
}