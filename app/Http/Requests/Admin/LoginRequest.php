<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|string',
        ];
    }
}
