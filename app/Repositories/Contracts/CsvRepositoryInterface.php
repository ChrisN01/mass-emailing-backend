<?php

namespace App\Repositories\Contracts;

interface CsvRepositoryInterface
{
    public function store(array $data): void;
}
