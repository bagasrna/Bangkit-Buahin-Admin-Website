<?php

namespace App\Exceptions;

use Exception;

class GulmaException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
