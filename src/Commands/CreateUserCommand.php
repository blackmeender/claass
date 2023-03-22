<?php

namespace Php2\Commands;

use PDO;

use Php2\Argument\Argument;
use Php2\Connection\SqLiteConnector;
use Php2\Exceptions\CommandException;
use Php2\Connection\ConnectorInterface;
use Php2\Date\DateTime;
use Php2\Exceptions\UserNotFoundException;
use Php2\User\Entities\User;
use Php2\User\Repositories\UserRepositoryInterface;

class CreateUserCommand implements CreateUserCommandInterface
{
    private PDO $connection;

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private ?ConnectorInterface $connector = null
    ) {
        $this->connector = $connector ?? new SqLiteConnector();

        $this->connection = $this->connector->getConnection();
    }

    public function handle(Argument $argument): void
    {
        $firstName = $argument->get('firstName');
        $lastName = $argument->get('lastName');
        $email = $argument->get('email');

        if ($this->userExist($email)) {
            throw new CommandException('User already exist: $email');
        }

        $statement = $this->connection->prepare(
            '
                insert into user (first_name, last_name, created_at, author_id, email)
                values (:first_name, :last_name, :created_at, :author_id, :email)
            '
        );

        /** @var User $author */
        $author = $argument->get('author');

        $statement->execute(
            [
                ':email' => $email,
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':author_id' => $author->getId(),
                ':created_at' => new DateTime()
            ]
        );
    }

    private function userExist(string $email)
    {
        try {
            $this->userRepository->findUserByEmail($email);
        } catch (UserNotFoundException $exception) {
            return false;
        }
        return true;
    }
}
