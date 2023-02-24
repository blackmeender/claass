<?php

namespace Php2\User\Repositories;


use Php2\User\Entities\User;

interface UserRepositoryInterface
{

    public function get(int $id): User;
    public function findUseByEmail(string $email): User;
}
