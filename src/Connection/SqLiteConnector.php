<?php

namespace Php2\Connection;

use PDO;

class SqLiteConnector implements ConnectorInterface
{
    public static PDO $pdo;

    public function __construct( PDO $pdo)
    {
        self::$pdo = $pdo;
    }

    public static function getConnection(): PDO
    {
        return self::$pdo;
    }
}
