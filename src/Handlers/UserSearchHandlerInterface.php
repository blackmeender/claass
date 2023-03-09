<?php

namespace Php2\Handlers;


use Php2\Requests\Request;
use Php2\Response\AbstractResponse;

interface UserSearchHandlerInterface
{
    public function handle(Request $request): AbstractResponse;
}