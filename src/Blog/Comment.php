<?php

namespace Php2\Blog;

use Php2\Blog\Post;
use Php2\Traits\Id;
use Php2\User\Entities\User;

class Comment
{
    use Id;
    public function __construct(
        private User $user,
        private Post $post,
        private string $text
    ) {
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }
}
