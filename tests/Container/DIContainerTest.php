<?php

namespace Test\Container;

use PDO;
use Php2\Blog\ClassWithoutDependencies;
use Php2\Blog\ClassWithParameter;
use Php2\Connection\ConnectorInterface;
use Php2\Connection\SqLiteConnector;
use Php2\Container\DiContainer;
use Php2\Handlers\UserSearchHandler;
use Php2\Handlers\UserSearchHandlerInterface;
use Php2\User\Repositories\UserRepository;
use Php2\User\Repositories\UserRepositoryInterface;
use PHPUnit\Framework\TestCase;

class DIContainerTest extends TestCase
{
    public function testItResolveClassWithoutDependencies()
    {
        $container = new DiContainer();

        $object = $container->get(ClassWithoutDependencies::class);

        $this->assertInstanceOf(ClassWithoutDependencies::class, $object);
    }

    public function testItResolveClassWithParameter()
    {
        $object = $container->get(ConnectorInterface::class);
        $this->assertInstanceOf(ConnectorInterface::class, $object);
    }

}