<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface PostRepository extends RepositoryInterface
{
    public function getPostsWithComments($perPage);
}