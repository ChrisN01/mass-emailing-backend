<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\CsvRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CsvRepository implements CsvRepositoryInterface
{
    public function storeBulkClients(array $clients): void        
    {      
        if(!empty($clients)){
            Client::insert($clients);
        }
        
        
    }

    public function existsByEmail(string $email): bool
    {
        return Client::where('email', $email)->exists();
    }
}
