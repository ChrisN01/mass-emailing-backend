<?php

namespace App\Validators\Contracts;

interface CsvValidatorInterface
{
    public function validatesFileHasSameColumns(array $headers): bool;
}