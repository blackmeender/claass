<?php

use Php2\Blog\Post;
use Php2\Blog\Comment;
use Php2\User\Entities\User;
use Php2\Repositories\PostRepository;
use Php2\Repositories\UserRepository;
use Php2\Repositories\CommentRepository;

require_once __DIR__ . '/autoload_runtime.php';

$userRepository = new UserRepository();
$postRepository = new PostRepository();
$commentRepository = new CommentRepository();

// $user = new User('Denis', 'Kovalev');
// $userRepository->save($user);
// $user = $userRepository->get(3);
// $post = new Post($user, 'ggg', 'ffffff');
// $postRepository->save($post);
// $user = var_dump($user);
// die();
// $post = $postRepository->get(2);
// $comment = new Comment($user, $post, 'dsfasdfff33');
// $commentRepository->save($comment);
// $comment = $commentRepository->get(2);
$comment = var_dump($comment);
die();
