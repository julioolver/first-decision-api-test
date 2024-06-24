<?php

namespace App\Exceptions;

use Exception;

class UserNotFoundException extends Exception
{
    protected $message = 'User not found';

    public function __construct()
    {
        parent::__construct($this->message, 404);

    }
}
