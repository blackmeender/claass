<?php

namespace Php2\Authentification;

use HttpException;
use Php2\Exceptions\AuthException;
use Php2\Requests\Request;
use Php2\User\Entities\User;
use Php2\User\Repositories\UserRepositoryInterface;
use InvalidArgumentException;

class JsonBodyIdentification implements IdentificationInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function user(Request $request): User
    {
        try {
            $userId = $request->jsonBodyField('auth_user');
            return $user = $this->userRepository->get($userId);
        } catch (HttpException $exception|InvalidArgumentException $exception)
        {
            throw new AuthException($exception->getMessage());
        }
    }
}