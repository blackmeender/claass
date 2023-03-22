<?php

use Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Php2\Authentification\IdentificationInterface;
use Php2\Authentification\JsonBodyIdentification;
use Php2\Commands\CreateUserCommand;
use Php2\Commands\CreateUserCommandInterface;
use Php2\Connection\ConnectorInterface;
use Php2\Connection\SqLiteConnector;
use Php2\Container\DiContainer;
use Php2\Handlers\UserCreateHandler;
use Php2\Handlers\UserCreateHandlerInterface;
use Php2\Handlers\UserSearchHandler;
use Php2\Handlers\UserSearchHandlerInterface;
use Php2\User\Repositories\UserRepository;
use Php2\User\Repositories\UserRepositoryInterface;
use Php2\Requests\Request;
use Psr\Log\LoggerInterface;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../database/config/config.php';

Dotenv::createImmutable(__DIR__ . '/../.env')->safeLoad();

$request = new Request($_GET, $_POST, $_SERVER, $_COOKIE, file_get_contents('php://input'));

$container = new DiContainer();

$container->bind(PDO::class, new PDO(databaseConfig()['sqlite']['DATABASE_URL']));

$logger = new Logger('php2_logger');
$isNeedLogToFile = (bool)$_SERVER['LOG_TO_FILE'] === 'true';
$isNeedLogToConsole = (bool)$_SERVER['LOG_TO_CONSOLE'] === 'true';

if ($isNeedLogToFile)
{
    $logger->pushHandler(new StreamHandler(__DIR__ . '/../var/log/php.log', Level::Info));
}

if ($isNeedLogToConsole)
{
    $logger->pushHandler(new StreamHandler("php://stdout"));
}

$container->bind(LoggerInterface::class, $logger);
$container->bind(ConnectorInterface::class, SqLiteConnector::class);
$container->bind(UserRepositoryInterface::class, UserRepository::class);
$container->bind(UserSearchHandlerInterface::class, UserSearchHandler::class);
$container->bind(CreateUserCommandInterface::class, CreateUserCommand::class);
$container->bind(UserCreateHandlerInterface::class, UserCreateHandler::class);
$container->bind(IdentificationInterface::class, JsonBodyIdentification::class);
return $container;