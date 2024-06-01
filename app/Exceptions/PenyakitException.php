<?php

namespace App\Exceptions;

use Exception;

class PenyakitException extends Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
