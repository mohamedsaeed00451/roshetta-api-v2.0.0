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
        $data = [
            'type' => 'bail|required|in:admin,doctor,patient,assistant,pharmacist',
        ];

        if ($this->type != null && in_array($this->type,['admin','doctor','patient','assistant','pharmacist'])) {

            $data['password'] = 'bail|required|string|min:8|confirmed';
            $data['email'] = 'bail|required|string|email|ends_with:gmail.com|exists:'.$this->type.'s'.',email';
            $data['otp'] = 'bail|required|min:6|max:6|regex:/^[0-9]*$/i';
        }

        return $data;

    }
}
