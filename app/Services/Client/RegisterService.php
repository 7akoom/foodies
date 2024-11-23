<?php

namespace App\Services\Client;

use App\Models\Client;

class RegisterService
{
    public function registerClient(array $validatedData)
    {
        $client = $this->createClient($validatedData);
        return $this->generateNotification('Registered Successfully', 'success');
    }

    protected function createClient(array $validatedData)
    {
        $client = new Client;
        $client->name = $validatedData['name'];
        $client->email = $validatedData['email'];
        $client->phone = $validatedData['phone'];
        $client->address = $validatedData['address'];
        $client->password = $validatedData['password'];
        $client->role = 'client';
        $client->status = '0';
        $client->save();

        return $client;
    }

    protected function generateNotification($message, $alertType)
    {
        return [
            'message' => $message,
            'alert-type' => $alertType
        ];
    }
}
