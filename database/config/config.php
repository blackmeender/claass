<?php

function databaseConfig(): array
{
    return [
        'sqlite' =>
        [
            'DATABASE_URL' => 'sqlite:' . __DIR__ . '/../dump/' . $_ENV['DATABASE_FILE']
        ]
    ];
}
