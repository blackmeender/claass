<?php

namespace Php2\Blog;

use Php2\Traits\Id;
use Php2\User\Entities\User;

class Post
{
    use Id;

    public function __construct(

        private User $author,
        private string $text,
        private string $header
    ) {
    }

    // public function __toString()
    // {
    //     return $this->author . ' пишет: ' . $this->text;
    // }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function setHeader($header)
    {
        $this->header = $header;

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
