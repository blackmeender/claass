<?php

namespace Php2\Handlers;


use Exception;
use Php2\Exceptions\UserNotFoundException;
use Php2\Handlers\UserSearchHandlerInterface;
use Php2\Requests\Request;
use Php2\Response\AbstractResponse;
use Php2\Response\ErrorResponse;
use Php2\Response\SuccessResponse;
use Php2\User\Repositories\UserRepositoryInterface;


class UserSearchHandler implements UserSearchHandlerInterface
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function handle(Request $request): AbstractResponse
    {
        try {
            $email = $request->query('email');
        } catch (Exception $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        try {
            $user = $this->userRepository->findUserByEmail($email);
        } catch (UserNotFoundException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        return new SuccessResponse(
            [
                'email' => $user->getEmail(),
                'name' => $user->getFirstName() . ' ' . $user->getLastName()
            ]
        );
    }
}