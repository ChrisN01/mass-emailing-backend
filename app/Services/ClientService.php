<?php

namespace App\Services;

use App\Repositories\Contracts\CsvRepositoryInterface;
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

    public function getSendEmails(array $clients): array
    {
        $unsavedClients=[];
        $emailsToSend=[];
        $newClients=[];
        $clientsToEmail=null;
        foreach ($clients as $client) {
            try
            {
                $this->validateClient($client);
                if($this->csvRepository->existsByEmail($client['email'])){
                    $emailsToSend[] = $client;
                    continue;
                }
                
                $newClients[] = $client;

            } catch (ValidationException $e)
            {
                $unsavedClients[] = $client;
                Log::error('Error validating customer information: ', [
                    'email' => $client['email'],
                    'error' => $e->getMessage()
                ]);
            }

        }

        $this->csvRepository->storeBulkClients($newClients);
        $clientsToEmail = array_merge($newClients, $emailsToSend);

        return $clientsToEmail;

    }

    public function validateClient(array $client): void
    {
        $validator = Validator::make($client, [
            'age' => 'required|integer|min:0',
            'gender' => 'required|string|in:M,F',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}