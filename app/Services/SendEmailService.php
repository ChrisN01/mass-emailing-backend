<?php

namespace App\Services;

use App\Mail\ClientNotification;
use Illuminate\Support\Facades\Mail;

class SendEmailService
{

    public function sendEmail(array $clients, $message): void
    {
        foreach ($clients as $client) {
            Mail::to($client['email'])->send(new ClientNotification($message,$client));
        }
    }
}