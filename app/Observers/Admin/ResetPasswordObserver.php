<?php

namespace App\Observers\Admin;

use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use App\Mail\FoodiesMail;

class ResetPasswordObserver
{
     public function updated(Admin $admin)
    {
        if ($admin->isDirty('token')) {
            $reset_link = url('admin/reset-password/' . $admin->token . '/' . $admin->email);
            $subject = 'Reset Password';
            $message = 'Please click the link below to reset your password:<br>';
            $message .= '<a href="' . $reset_link . '">Click Here</a>';

            Mail::to($admin->email)->send(new FoodiesMail($subject, $message));
        }
    }
}
