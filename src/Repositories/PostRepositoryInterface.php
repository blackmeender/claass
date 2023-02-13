<?php

namespace Php2\Repositories;

use Php2\Blog\Post;

interface PostRepositoryInterface
{
    public function save(Post $post): void;
    public function get(int $id): Post;
}
