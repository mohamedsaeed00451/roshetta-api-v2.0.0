<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            $data['name'] = 'bail|required|regex:/^[\p{Arabic}\p{L}\s]+$/u|min:5|max:50';
            $data['ssd'] = 'bail|required|regex:/^[1-9]\d{13}$/|unique:'.$this->type.'s'.',ssd';
            $data['email'] = 'bail|required|email|string|ends_with:gmail.com|unique:'.$this->type.'s'.',email';
            $data['phone'] = 'bail|required|regex:/^[1-9]\d{9}$/|unique:'.$this->type.'s'.',phone';
            $data['gender_id'] = 'bail|required|int|in:1,2';
            $data['birth_date'] = 'bail|required|date_format:Y-m-d|before:today';
            $data['governorate_id'] = 'bail|required|int|exists:governorates,id';
            $data['password'] = 'bail|required|string|min:8|confirmed';
            $data['email_code'] = 'bail|required|min:6|max:6|regex:/^[0-9]*$/i';
            $data['terms_and_conditions'] = 'bail|required|accepted';
        }

        if ($this->type == 'doctor') {
            $data['specialist_id'] = 'bail|required|int|exists:specialists,id';
        }

        if ($this->type == 'patient') {
            $data['weight'] = 'bail|required|numeric';
            $data['height'] = 'bail|required|numeric';
        }

        return $data;
    }

}
