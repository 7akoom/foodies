<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class PasswordService
{
    public function handlePasswordReset(array $data)
    {
        $client = Admin::whereEmail($data['email'])->first();
        
        if (!$client) {
            return 'Email Not Found';
        }

        $token = Hash::make(time());

        $client->token = $token;
        $client->update();

        return true;
    }
}