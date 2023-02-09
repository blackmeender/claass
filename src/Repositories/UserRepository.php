<?php

namespace Php2\Repositories;

use Php2\Repositories\UserRepositoryInterface;
use Php2\Exceptions\UserNotFoundException;
use Php2\User\Entities\User;

class UserRepository implements UserRepositoryInterface
{
    private array $users = [];

    public function save(User $users): void
    {
        $this->users[] = $users;
    }

    public function get(int $id): User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }


        throw new UserNotFoundException();
    }
}
