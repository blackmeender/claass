<?php

namespace Php2\Commands;

use Php2\Argument\Argument;

interface CreateUserCommandInterface
{
    public function handle(Argument $rargument): void;
}
