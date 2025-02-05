<?php

namespace App\Validators;

use App\Validators\Contracts\CsvValidatorInterface;

class CsvValidator implements CsvValidatorInterface
{
    protected array $expectedColumns = ['name', 'age', 'gender', 'phone', 'email'];

    public function validatesFileHasSameColumns(array $headers): bool
    {
        return $headers === $this->expectedColumns;
    }
}
