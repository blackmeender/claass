<?php

namespace Php2\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    protected $message = 'User not found';
}
