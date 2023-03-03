<?php

namespace Php2\User\Repositories;

use PDO;
use Php2\Date\DateTime;
use Php2\User\Entities\User;
use Php2\Connection\SqLiteConnector;
use Php2\Connection\ConnectorInterface;
use Php2\Exceptions\UserNotFoundException;
use Php2\User\Repositories\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private PDO $connection;

    public function __construct(private ?ConnectorInterface $connector = null)
    {
        $this->connector = $connector ?? new SqLiteConnector();

        $this->connection = $this->connector->getConnection();
    }

    public function get(int $id): User
    {
        $statement = $this->connection->prepare(
            'select * from user where id = :userId'
        );

        $statement->execute(
            [
                ':userId' => $id
            ]
        );

        $userObj = $statement->fetch(PDO::FETCH_OBJ);

        if (!$userObj) {
            throw new UserNotFoundException("User with id: $id not found");
        }

        return $this->mapUser($userObj);
    }

    public function findUserByEmail(string $email): User
    {
        $statement = $this->connection->prepare(
            'select * from user where email = :email'
        );

        $statement->execute(
            [
                ':email' => $email
            ]
        );

        $userObj = $statement->fetch(PDO::FETCH_OBJ);

        if (!$userObj) {
            throw new UserNotFoundException("User with email: $email not found");
        }

        return $this->mapUser($userObj);
    }

    public function mapUser(object $userObj): User
    {

        $user = new User($userObj->first_name, $userObj->last_name, $userObj->email);

        $user->setId($userObj->id);
        $user->active($userObj->active);
        $user->setCreatedAt(new DateTime($userObj->created_at));
        $user->setUpdatedAt(($updatedAt = $userObj->updated_at) ? new DateTime($updatedAt) : null);
        $user->setDeletedAt(($deletedAt = $userObj->deleted_at) ? new DateTime($deletedAt) : null);


        return $user;
    }
}
