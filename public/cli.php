<?php

use Php2\Argument\Argument;
use Php2\Commands\CreateUserCommand;
use Php2\Exceptions\CommandException;
use Php2\Repositories\PostRepository;
use Php2\User\Repositories\UserRepository;
use Php2\Repositories\CommentRepository;
use Php2\Requests\Request;

require_once __DIR__ . '/autoload_runtime.php';

$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE);
$parameter = $request->query('some_parameter');
$parameter = $request->header('some_header');
$path = $request->path();
$response = new SuccessResponse(['message' => 'hello PHP']);
$response->send();

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
