<?php

use Php2\Connection\SqLiteConnector;



require_once __DIR__ . '/autoload_runtime.php';

$now = new DateTimeImmutable();
$connection = SqLiteConnector::getConnection();
$connection
    ->exec(
        "insert into user (first_name, last_name, created_at) 
        values ('Ivan', 'Ivanov', {$now->format('Y-m-d H:i:s')})"
    );
