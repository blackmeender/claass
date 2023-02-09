<?php

namespace Php2\Repositories;


use Php2\User\Entities\User;

interface UserRepositoryInterface
{
    public function save(User $users): void;
    public function get(int $id): User;
}
