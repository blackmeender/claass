<?php

namespace Php2\User\Entities;

use Php2\Date\DateTime;
use Php2\Traits\Active;
use Php2\Traits\Created;
use Php2\Traits\Deleted;
use Php2\Traits\Id;
use Php2\Traits\Updated;

class User
{
    use Id;
    use Active;
    use Created;
    use Updated;
    use Deleted;

    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private ?User $author = null
    ) {
        $this->createdAt = new DateTime();
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function getEmail()
    {
        return $this->email;
    }
}
