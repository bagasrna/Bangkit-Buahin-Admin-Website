<?php

namespace App\Exceptions;

use Exception;

class HamaException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
