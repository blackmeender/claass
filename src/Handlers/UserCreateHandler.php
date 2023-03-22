<?php

namespace Php2\Handlers;


use Exception;
use Php2\Argument\Argument;
use Php2\Commands\CreateUserCommandInterface;
use Php2\Exceptions\UserNotFoundException;
use Php2\Handlers\UserSearchHandlerInterface;
use Php2\Requests\Request;
use Php2\Response\AbstractResponse;
use Php2\Response\ErrorResponse;
use Php2\Response\SuccessResponse;
use Php2\User\Repositories\UserRepositoryInterface;
use Psr\Log\LoggerInterface;
use Php2\Authentification\IdentificationInterface;


class UserCreateHandler implements UserCreateHandlerInterface
{
    public function __construct(
        private CreateUserCommandInterface $createUserCommand,
        private IdentificationInterface $identification,
        private UserRepositoryInterface $userRepository,
        private LoggerInterface $logger
    )
    {
    }

    public function handle(Request $request): AbstractResponse
    {
        $email = $request->jsonBodyField('email');
        try {
            $argument = new Argument([
                'email'=>$request->query('email'),
                'firstName'=>$firstName = $request->query('firstName'),
                'lastName'=>$lastname = $request->query('lastName'),
                'author'=>$this->identification->user($request)
            ]);

            $this->createUserCommand->handle($argument);

            $email = $request->query('email');
            $firstName = $request->query('firstName');
            $lastname = $request->query('lastName');
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage());
            return new ErrorResponse($exception->getMessage());
        }

        try {
            $user = $this->userRepository->findUserByEmail($email);
        } catch (UserNotFoundException $exception) {
            $this->logger->error($exception->getMessage());
            return new ErrorResponse($exception->getMessage());
        }

        $this->logger->info('User found: ' . $user->getId());

        return new SuccessResponse(
            [
                'email' => $user->getEmail(),
                'name' => $user->getFirstName() . ' ' . $user->getLastName()
            ]
        );
    }
}