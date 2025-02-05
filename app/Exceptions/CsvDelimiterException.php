<?php

namespace App\Exceptions;

use Exception;

class CsvDelimiterException extends Exception
{
    public function __construct($message = "Invalid delimiter. Use ',' instead of ';'",  $code=422 )
    {
        parent::__construct($message, $code);
    }
}
