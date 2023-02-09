<?php

namespace Php2\Connection;

use PDO;

class SqLiteConnector implements ConnectorInterface
{

    public static function getConnection(): PDO
    {
        return new PDO(databaseConfig()['sqlite']['DATABASE_URL']);
    }
}
