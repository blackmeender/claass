<?php

namespace Test\Handlers;

use Php2\Exceptions\UserNotFoundException;
use Php2\Handlers\UserSearchHandler;
use Php2\Handlers\UserSearchHandlerInterface;
use Php2\Requests\Request;
use Php2\Response\ErrorResponse;
use Php2\Response\SuccessResponse;
use Php2\User\Entities\User;
use Php2\User\Repositories\UserRepository;
use Php2\User\Repositories\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\JsonResponse;


class FindUserByEmailHandlerTest extends TestCase
{
    public function __construct(
        ?string $name = null,
        array $data = [],
        $dataName = '',
        private ?UserRepositoryInterface $userRepository = null,
        private ?UserSearchHandlerInterface $userSearchHandler = null
    ) {
        $this->userRepository ??= new UserRepository();
        $this->userSearchHandler = $this->userSearchHandler ?? new UserSearchHandler($this->userRepository);
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @throws \JsonException
     */
    public function testItReturnsErrorResponseIfNoEmailProvided(): void
    {
        $request = new Request([], []);
        $response = $this->userSearchHandler->handle($request);
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->expectOutputString('{"success":false,"reason":"Empty query param in the request: email"}');
        echo json_encode($response);
    }

    /**
     * @throws \JsonException
     */
    public function testItReturnsErrorResponseIfUserNotFound(): void
    {
        $request = new Request(['email' => 'sam@mail.ru'], []);
        $response = $this->userSearchHandler->handle($request);
        $this->assertInstanceOf(ErrorResponse::class, $response);
        $this->expectOutputString('{"success":false,"reason":"No such query param in the request: email"}');
        echo json_encode($response);
    }

    /**
     * @throws \JsonException
     */
    public function testItReturnsSuccessResponse(): void
    {
        $request = new Request(['email' => 'same.98@mail.ru'], []);
        $response = $this->userSearchHandler->handle($request);
        $this->assertInstanceOf(SuccessResponse::class, $response);
        $this->expectOutputString('{"success": true, "data": {"email": "sam@mail.ru", "name": "Alex Litvinov"}}');
        echo json_encode($response);
    }

    public function userRepository(array $users): UserRepositoryInterface
    {
        return new class($users) implements UserRepositoryInterface
        {
            public function __construct(
                private array $users
            ) {
            }

            public function save(User $user): void
            {
            }
            public function get(int $id): User
            {
                throw new UserNotFoundException("Not Found");
            }

            public function findUserByEmail(string $email): User
            {
                foreach ($this->users as $user) {
                    if ($user instanceof User && $email === $user->getEmail()) {
                        return $user;
                    }
                }

                throw new UserNotFoundException("not found");
            }
        };
    }
}
