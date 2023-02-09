<?php

use Php2\User\Entities\User;
use Php2\Repositories\UserRepository;

require_once __DIR__ . '/autoload_runtime.php';

$userRepository = new UserRepository();
$user = new User('Denis', 'Kovalev');
$userRepository->save($user);
