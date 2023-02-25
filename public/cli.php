<?php

use Php2\Argument\Argument;
use Php2\Commands\CreateUserCommand;
use Php2\Exceptions\CommandException;
use Php2\Repositories\PostRepository;
use Php2\User\Repositories\UserRepository;
use Php2\Repositories\CommentRepository;

require_once __DIR__ . '/autoload_runtime.php';

$userRepository = new UserRepository();
$postRepository = new PostRepository();
$commentRepository = new CommentRepository();

$command = new CreateUserCommand($userRepository);

try {
    $command->handle(Argument::fromArgv($argv));
    echo 'Все ок';
} catch (CommandException $commandExeption) {
    echo $commandExeption->getMessage();
}
