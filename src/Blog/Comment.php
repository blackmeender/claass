<?php

namespace Php2\Blog;

use Php2\Blog\Post;
use Php2\Traits\Id;
use Php2\User\Entities\User;

class Comment
{
    use Id;
    public function __construct(
        private User $author,
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

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }
}
