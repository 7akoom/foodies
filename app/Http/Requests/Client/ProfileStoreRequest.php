<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileStoreRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:200',
            'email' => 'required|email|unique:clients,email,' . Auth::guard('client')->id(),
            'phone' => 'nullable|string|regex:/^\+?[1-9]\d{1,14}$/',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Please enter a valid phone number.',
            'photo.mimes' => 'The image must be of type: jpeg, png, jpg,webp or gif.',
            'photo.max' => 'The image size must be less than 2MB.',
            'cover_photo.mimes' => 'The image must be of type: jpeg, png, jpg, webp or gif.',
            'cover_photo.max' => 'The image size must be less than 2MB.',
        ];
    }
}
