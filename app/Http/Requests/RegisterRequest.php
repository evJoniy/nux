<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'username' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'mobile.required' => 'Phone number is required.',
        ];
    }
}
