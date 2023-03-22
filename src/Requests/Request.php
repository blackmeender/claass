<?php

namespace Php2\Requests;

use Exception;
use JsonException;


class Request
{
    public function __construct(
        private array $get=[],
        private array $post=[],
        private array $server=[],
        private array $cookies =[],
        private string $body
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

    public function jsonBodyField(string $key): string
    {
        try {
            $data = json_decode($this->body);
            if (!array_key_exists($key, $data))
            {
                throw new Exception('Поле не найдено');
            }
            if(empty($data[$key]))
            {
                throw new HttpException('Пустые данные');
            }
            return $data[$key];
        } catch (JsonException $exception)
        {
            throw new Exception($exception);
        }
    }
}