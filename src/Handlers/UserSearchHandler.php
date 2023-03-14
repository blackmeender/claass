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
use Psr\Log\LoggerInterface;


class UserSearchHandler implements UserSearchHandlerInterface
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private LoggerInterface $logger
    )
    {
    }

    public function handle(Request $request): AbstractResponse
    {
        $this->logger->debug('User searching' . (new DateTime())->format('d.m.Y H:i:s'));

        try {
            $email = $request->query('email');
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return new ErrorResponse($exception->getMessage());
        }

        try {
            $user = $this->userRepository->findUserByEmail($email);
        } catch (UserNotFoundException $exception) {
            return new ErrorResponse($exception->getMessage());
        }

        $this->logger->info('User found: ' . $user->getId());

        $this->logger->debug('Finish user searching' . (new DateTime())->format('d.m.Y H:i:s'));

        return new SuccessResponse(
            [
                'email' => $user->getEmail(),
                'name' => $user->getFirstName() . ' ' . $user->getLastName()
            ]
        );
    }
}