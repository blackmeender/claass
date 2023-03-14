<?php

use Php2\Connection\ConnectorInterface;
use Php2\Connection\SqLiteConnector;
use Php2\Container\DiContainer;
use Php2\Handlers\UserSearchHandler;
use Php2\Handlers\UserSearchHandlerInterface;
use Php2\User\Repositories\UserRepository;
use Php2\User\Repositories\UserRepositoryInterface;
use Php2\Requests\Request;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/config/config.php';

$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE);

$container = new DiContainer();

$container->bind(PDO::class, new PDO(databaseConfig()['sqlite']['DATABASE_URL']));
$container->bind(ConnectorInterface::class, SqLiteConnector::class);
$container->bind(UserRepositoryInterface::class, UserRepository::class);
$container->bind(UserSearchHandlerInterface::class, UserSearchHandler::class);
return $container;