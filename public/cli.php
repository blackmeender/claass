<?php
/** @var ContainerInterface $container */
/** @var Request $request */
use Php2\Handlers\UserSearchHandlerInterface;
use Php2\User\Repositories\UserRepositoryInterface;
use Php2\Requests\Request;
use Psr\Container\ContainerInterface;

$container = require_once __DIR__ . '/autoload_runtime.php';

$userRepository = $container->get(UserRepositoryInterface::class);

/** @var  $handler */
$handler = $container->get(UserSearchHandlerInterface::class);
$handler->handle($request);