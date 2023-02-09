<?php

namespace Php2\Connection;

use PDO;

interface ConnectorInterface
{
    public static function getConnection(): PDO;
}
