<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class PasswordUpdateService
{
    public function updatePassword(Admin $admin, array $validatedData)
    {
        if (!$this->checkOldPassword($validatedData['old_password'], $admin->password)) {
            return $this->generateNotification('Old Password Does Not Match!', 'error');
        }

        $this->saveNewPassword($admin, $validatedData['new_password']);
        return $this->generateNotification('Password Updated Successfully', 'success');
    }

    protected function checkOldPassword($oldPassword, $hashedPassword)
    {
        return Hash::check($oldPassword, $hashedPassword);
    }

    protected function saveNewPassword(Admin $admin, $newPassword)
    {
        $admin->update(['password' => Hash::make($newPassword)]);
    }

    protected function generateNotification($message, $alertType)
    {
        return [
            'message' => $message,
            'alert-type' => $alertType
        ];
    }
}