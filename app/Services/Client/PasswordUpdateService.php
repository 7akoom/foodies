<?php

namespace App\Services\Client;

use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateService
{
    public function updatePassword(Client $client, array $validatedData)
    {
        if (!$this->checkOldPassword($validatedData['old_password'], $client->password)) {
            return $this->generateNotification('Old Password Does Not Match!', 'error');
        }

        $this->saveNewPassword($client, $validatedData['new_password']);
        return $this->generateNotification('Password Updated Successfully', 'success');
    }

    protected function checkOldPassword($oldPassword, $hashedPassword)
    {
        return Hash::check($oldPassword, $hashedPassword);
    }

    protected function saveNewPassword(Client $client, $newPassword)
    {
        $client->update(['password' => Hash::make($newPassword)]);
    }

    protected function generateNotification($message, $alertType)
    {
        return [
            'message' => $message,
            'alert-type' => $alertType
        ];
    }
}