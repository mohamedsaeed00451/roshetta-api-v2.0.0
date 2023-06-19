<?php

namespace App\Http\Requests\Api\Clinic;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClinicImageRequest extends FormRequest
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
            'clinic_id' => 'bail|required|int|exists:clinics,id',
            'logo' => 'bail|required|image|max:2000'
        ];
    }
}
