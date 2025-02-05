<?php

namespace App\Exceptions;

use Exception;

class CsvFormatException extends Exception
{
    public function __construct($message = "CSV file is empty or incorrectly formatted", $code=400)
    {
        parent::__construct($message, $code);
        
    }
}
