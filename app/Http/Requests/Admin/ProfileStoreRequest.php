<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email,' . Auth::guard('admin')->id(),
            'phone' => 'string|regex:/^\+?[1-9]\d{1,14}$/',
            'address' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Please enter a valid phone number.',
            'photo.mimes' => 'The image must be of type: jpeg, png, jpg,webp or gif.',
            'photo.max' => 'The image size must be less than 2MB.',
        ];
    }
}
