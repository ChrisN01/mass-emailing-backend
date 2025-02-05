<?php

namespace App\Exceptions;

use Exception;

class CsvOpenException extends Exception
{
    public function __construct($message="Unable to open CSV file", $code=400)
    {
        parent::__construct($message, $code);
    }
}
