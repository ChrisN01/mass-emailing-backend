<?php

namespace App\Repositories\Contracts;

interface CsvRepositoryInterface
{
    public function storeBulkClients(array $data): void;

    public function existsByEmail(string $email): bool;
}
