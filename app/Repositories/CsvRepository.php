<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\CsvRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CsvRepository implements CsvRepositoryInterface
{
    protected array $expectedColumns = ['name', 'age', 'gender', 'phone', 'email'];
    public function store(array $data): void
    {
        DB::transaction(function () use ($data)
        {
            foreach ($data as $key => $value) {
                Client::create([
                    'name' => $value['name'],
                    'age' => $value['age'],
                    'gender' => $value['gender'],
                    'phone' => $value['phone'],
                    'email' => $value['email'],
                ]);
            }
        });
    }
}
