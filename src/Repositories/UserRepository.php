<?php

namespace Php2\Repositories;

use PDO;
use Php2\Connection\ConnectorInterface;
use Php2\Connection\SqLiteConnector;
use Php2\Repositories\UserRepositoryInterface;
use Php2\Exceptions\UserNotFoundException;
use Php2\User\Entities\User;

class UserRepository implements UserRepositoryInterface
{
    private PDO $connection;

    public function __construct(private ?ConnectorInterface $connector = null)
    {
        $this->connector = $connector ?? new SqLiteConnector();

        $this->connection = $this->connector->getConnection();
    }

    public function save(User $user): void
    {
        $statement = $this->connection->prepare(
            '
                insert into user (first_name, last_name, created_at)
                values (:first_name, :last_name, :created_at)
            '
        );

        $statement->execute(
            [
                ':first_name' => $user->getFirstName(),
                ':last_name' => $user->getLastName(),
                ':created_at' => $user->getCreatedAt(),
            ]
        );
    }

    public function get(int $id): User
    {
        $statement = $this->connection->prepare(
            'select * from user where id = :userid'
        );

        $statement->execute(
            [
                'userId' => $id
            ]
        );

        $userObj = $statement->fetch(PDO::FETCH_OBJ);

        if (!$userObj) {
            throw new UserNotFoundException("USer with id $id not found");
        }

        $user = new User($userObj->first_name, $userObj->last_name);
        $user
            ->setId($userObj->id)
            ->setCreatedAt($userObj->created_at)
            ->setUpdatedAt($userObj->updated_at)
            ->setDeletedAt($userObj->deleted_at);


        return $user;
    }
}
