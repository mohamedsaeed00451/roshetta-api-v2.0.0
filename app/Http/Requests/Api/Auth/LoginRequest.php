<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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

            $data['ssd'] = 'bail|required|regex:/^[1-9]\d{13}$/|exists:'.$this->type.'s'.',ssd';
            $data['password'] = 'bail|required|string';

        }

        return $data;
    }
}
