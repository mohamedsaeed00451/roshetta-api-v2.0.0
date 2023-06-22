<?php

namespace App\Http\Requests\Api\Appointment;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
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
        return request()->isMethod('put') || request()->isMethod('patch') ?
            $this->onUpdate() : $this->onCreate();
    }

    public function onCreate()
    {
        return [
            'clinic_id' => 'bail|required|int|exists:clinics,id',
            'date' => 'bail|required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d').''
        ];
    }

    public function onUpdate()
    {
        return [
            'date' => 'bail|required|date_format:Y-m-d|after_or_equal:'.date('Y-m-d').''
        ];
    }
}
