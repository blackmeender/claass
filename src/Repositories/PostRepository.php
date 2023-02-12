<?php

namespace Php2\Repositories;

use PDO;
use Php2\Blog\Post;
use Php2\Connection\SqLiteConnector;
use Php2\Connection\ConnectorInterface;
use Php2\Exceptions\PostNotFoundExeption;

class PostRepository implements PostRepositoryInterface
{
    private PDO $connection;

    public function __construct(private ?ConnectorInterface $connector = null)
    {
        $this->connector = $connector ?? new SqLiteConnector();

        $this->connection = $this->connector->getConnection();
    }

    public function save(Post $post): void
    {
        $statement = $this->connection->prepare(
            '
                insert into post (user_id, header, text)
                values (:user_id, :header, :text)
            '
        );

        $statement->execute(
            [
                ':user_id' => $post->getAuthor()->getId(),
                ':header' => $post->getHeader(),
                ':text' => $post->getText(),
            ]
        );
    }

    // public function get(int $id): Post
    // {
    //     $statement = $this->connection->prepare(
    //         'select * from user where id = :userId'
    //     );

    //     $statement->execute(
    //         [
    //             ':userId' => $id
    //         ]
    //     );

    //     $userObj = $statement->fetch(PDO::FETCH_OBJ);


    //     if (!$userObj) {
    //         throw new PostNotFoundExeption("Post with id: $id not found");
    //     }

    //     // $createdAt = new DateTime($userObj->created_at);
    //     // var_dump($createdAt);
    //     // die();

    //     $user = new User($userObj->first_name, $userObj->last_name, $userObj->created_at);
    //     $user
    //         ->setId($userObj->id)
    //         ->active($userObj->active)
    //         ->setCreatedAt(new DateTime($userObj->created_at))
    //         ->setUpdatedAt(($updatedAt = $userObj->updated_at) ? new DateTime($updatedAt) : null)
    //         ->setDeletedAt(($deletedAt = $userObj->deleted_at) ? new DateTime($deletedAt) : null);


    //     return $user;
    // }
}
