<?php

namespace App\Http\Requests\Api\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
        $data = [];

        if ($this->type != null && in_array($this->type,['admin','doctor','patient','assistant','pharmacist'])) {

            $data['phone'] = 'bail|required|regex:/^[1-9]\d{9}$/|unique:'.$this->type.'s'.',phone,'.auth()->user()->id;
            $data['governorate_id'] = 'bail|required|int|exists:governorates,id';

        }

        if ($this->type == 'doctor') {
            $data['brief']  = 'bail|nullable|string';
        }

        if ($this->type == 'patient') {
            $data['weight'] = 'bail|required|numeric';
            $data['height'] = 'bail|required|numeric';
        }

        return $data;

    }
}
