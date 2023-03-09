<?php

namespace Php2\Requests;

use Exception;


class Request
{
    public function __construct(
        private array $get=[],
        private array $post=[],
        private array $server=[],
        private array $cookies =[]
    )
    {
    }

    public function path()
    {
        if (!array_key_exists('REQUEST_URI', $this->server))
        {
            throw new Exception('Cant get path the request');
        }

        $components = parse_url($this->server['REQUEST_URI']);

        if (!is_array($components) || array_key_exists('path', $components))
        {
            throw new Exception('cant get path the request');
        }

        return $components['path'];
    }

    public function query(string $param): string
    {
        if (array_key_exists($param, $this->get))
        {
            throw new Exception("No such query param in the request: $param");
        }

        $value = trim($this->get[$param]);
        if (empty($value))
        {
            throw new Exception("Empty query param in the request: $param");
        }

        return $value;
    }
}