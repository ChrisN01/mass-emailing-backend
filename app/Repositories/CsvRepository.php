<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\CsvRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CsvRepository implements CsvRepositoryInterface
{
    public function store(array $client): void        
    {           
        Client::create([
            'name' => $client['name'],
            'age' => $client['age'],
            'gender' => $client['gender'],
            'phone' => $client['phone'],
            'email' => $client['email'],
       ]);
        
    }
}
