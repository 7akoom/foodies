<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class RegisterSubmitRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'nullable|string|regex:/^\+?[1-9]\d{1,14}$/',
            'address' => 'nullable|string|max:255',
            'password' => 'string|min:5'
        ];
    }
}
