<?php

namespace Php2\User\Entities;


use Php2\Traits\Created;
use Php2\Traits\Deleted;
use Php2\Traits\Id;
use Php2\Traits\Updated;

class User
{
    use Id;
    use Created;
    use Updated;
    use Deleted;

    public function __construct(
        private string $firstName,
        private string $lastName,
    ) {
    }

    public function __toString()
    {
        return $this->firstName .
            " " . $this->lastName .
            ' на сайте с ' . $this->createdAt->format('Y-m-d');
    }
}
