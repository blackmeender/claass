<?php

namespace Php2\Connection;

use PDO;

class SqLiteConnector implements ConnectorInterface
{
    public static PDO $pdo;

    public function __construct( PDO $dsn)
    {
        self::$pdo = $dsn;
    }

    public static function getConnection(): PDO
    {
        return self::$pdo;
    }
}
