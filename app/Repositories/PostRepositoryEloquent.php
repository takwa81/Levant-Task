<?php

namespace App\Repositories;

use App\Models\Post;
use Prettus\Repository\Eloquent\BaseRepository;

class PostRepositoryEloquent extends BaseRepository implements PostRepository
{
    public function model()
    {
        return Post::class;
    }

    public function getPostsWithComments($perPage)
    {
        return $this->model
            ->with(['comments.user'])
            ->latest()
            ->paginate($perPage);
    }
}