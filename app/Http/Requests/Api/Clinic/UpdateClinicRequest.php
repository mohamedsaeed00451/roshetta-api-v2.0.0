<?php

namespace App\Http\Requests\Api\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicRequest extends FormRequest
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
            'name' => 'bail|required|regex:/^[\p{Arabic}\p{L}\s]+$/u|min:5|max:50',
            'phone' => 'bail|required|regex:/^[1-9]\d{9}$/|unique:clinics,phone,'.$this->id,
            'governorate_id' => 'bail|required|int|exists:governorates,id',
            'specialist_id' => 'bail|required|int|exists:specialists,id',
            'price' => 'bail|required|numeric',
            'start_working' => 'bail|required|date_format:H:i:s',
            'end_working' => 'bail|required|date_format:H:i:s|after:start_working',
            'address' => 'bail|required|string',
        ];
    }
}
