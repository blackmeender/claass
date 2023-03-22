<?php

namespace Php2\Authentification;

use Php2\Requests\Request;
use Php2\User\Entities\User;

interface IdentificationInterface
{
    public function user(Request $request): User;
}