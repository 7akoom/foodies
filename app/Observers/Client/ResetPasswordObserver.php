<?php

namespace App\Observers\Client;

use App\Models\Client;
use Illuminate\Support\Facades\Mail;
use App\Mail\FoodiesMail;

class ResetPasswordObserver
{
     public function updated(Client $client)
    {
        if ($client->isDirty('token')) {
            $reset_link = url('client/reset-password/' . $client->token . '/' . $client->email);
            $subject = 'Reset Password';
            $message = 'Please click the link below to reset your password:<br>';
            $message .= '<a href="' . $reset_link . '">Click Here</a>';

            Mail::to($client->email)->send(new FoodiesMail($subject, $message));
        }
    }
}
