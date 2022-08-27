<?php

namespace App\Exceptions;

use Exception;

class CarNotBelongUserException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Car does not belong to the user");
    }
}
