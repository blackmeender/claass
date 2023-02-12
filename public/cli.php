<?php

use Php2\Blog\Post;
use Php2\User\Entities\User;
use Php2\Repositories\PostRepository;
use Php2\Repositories\UserRepository;

require_once __DIR__ . '/autoload_runtime.php';

$userRepository = new UserRepository();
$postRepository = new PostRepository();


// $user = new User('Denis', 'Kovalev');
// $userRepository->save($user);
$user = $userRepository->get(3);
$post = new Post($user, 'ggg', 'ffffff');
$postRepository->save($post);
// $user = var_dump($user);
// die();
