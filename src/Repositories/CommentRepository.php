<?php

namespace Php2\Repositories;

use PDO;
use Php2\Blog\Comment;
use Php2\Connection\SqLiteConnector;
use Php2\Connection\ConnectorInterface;
use Php2\Exceptions\CommentNotFoundExeption;
use Php2\Repositories\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    private PDO $connection;

    public function __construct(private ?ConnectorInterface $connector = null)
    {
        $this->connector = $connector ?? new SqLiteConnector();

        $this->connection = $this->connector->getConnection();
    }

    public function save(Comment $comment): void
    {
        $statement = $this->connection->prepare(
            '
                insert into comment (user_id, post_id, text)
                values (:user_id, :post_id, :text)
            '
        );

        $statement->execute(
            [
                ':user_id' => $comment->getAuthor()->getId(),
                ':post_id' => $comment->getPost()->getId(),
                ':text' => $comment->getText(),
            ]
        );
    }

    public function get(int $id): Comment
    {
        $statement = $this->connection->prepare(
            'select * from comment where id = :commentId'
        );

        $statement->execute(
            [
                ':commentId' => $id
            ]
        );

        $commentObj = $statement->fetch(PDO::FETCH_OBJ);


        if (!$commentObj) {
            throw new CommentNotFoundExeption("Comment with id: $id not found");
        }

        // $createdAt = new DateTime($userObj->created_at);
        // var_dump($createdAt);
        // die();

        $userRepository = new UserRepository();
        $user = $userRepository->get($commentObj->user_id);
        $postRepository = new PostRepository();
        $post = $postRepository->get($commentObj->post_id);
        $comment = new Comment($user,  $post, $commentObj->text);
        $comment->setId($commentObj->id);


        return $comment;
    }
}
