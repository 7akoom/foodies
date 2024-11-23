<?php

namespace App\Services\Client;

use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class PasswordService
{
    public function handlePasswordReset(array $data)
    {
        $client = Client::whereEmail($data['email'])->first();
        
        if (!$client) {
            return 'Email Not Found';
        }

        $token = Hash::make(time());

        $client->token = $token;
        $client->update();

        return true;
    }
}