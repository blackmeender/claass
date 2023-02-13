<?php

namespace Php2\Repositories;

use Php2\Blog\Comment;

interface CommentRepositoryInterface
{
    public function save(Comment $post): void;
    public function get(int $id): Comment;
}
