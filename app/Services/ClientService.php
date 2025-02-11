<?php

namespace App\Services;

use App\Repositories\Contracts\CsvRepositoryInterface;
use App\Repositories\CsvRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ClientService
{

    protected $csvRepository;
    public function __construct(CsvRepositoryInterface $csvRepository)
    {
        $this->csvRepository = $csvRepository;
    }

    public function storeClients(array $clients): void
    {
        $unsavedClient=[];
        foreach ($clients as $client) {

            try
            {
                $this->validateClient($client);
            
                $this->csvRepository->store($client);
            } catch (ValidationException $e)
            {
                $unsavedClient[] = $client;
                Log::error('Error validating customer information: ', [
                    'email' => $client['email'],
                    'error' => $e->getMessage()
                ]);
            }

        }
    }

    public function validateClient(array $client): void
    {
        $validator = Validator::make($client, [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:M,F',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:clients,email',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}