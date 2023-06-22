<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class resetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => 'bail|required|string|min:8|confirmed',
            'email' => 'bail|required|string|email|ends_with:gmail.com|exists:' . $this->type . 's' . ',email',
            'otp' => 'bail|required|min:6|max:6|regex:/^[0-9]*$/i'
        ];

    }
}
