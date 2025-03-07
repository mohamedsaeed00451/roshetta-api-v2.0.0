<?php

namespace App\Http\Requests\Api\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class AddPrescriptRequest extends FormRequest
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
            'type' => 'bail|required|string|in:new,rediscovery'
        ];

        if ($this->type != null && in_array($this->type,['new','rediscovery'])) {

            if ($this->type == 'new') {
                $data['disease_name'] = 'bail|required|regex:/^[\p{Arabic}\p{L}\s]+$/u|max:100';
                $data['disease_place'] = 'bail|required|regex:/^[\p{Arabic}\p{L}\s]+$/u|max:100';
            }

            if ($this->type == 'rediscovery') {
                $data['disease_id'] = 'bail|required|int|exists:diseases,id';
            }

            $data['rediscovery_date'] = 'bail|nullable|date_format:Y-m-d|after:'.date('Y-m-d').'';
            $data['appointment_id'] = 'bail|required|int|exists:appointments,id';

            $data['medicines'] = 'bail|required|array';
            $data['medicines.*.name'] = 'bail|required|regex:/^[\p{Arabic}\p{L}\s]+$/u|max:100';
            $data['medicines.*.size'] = 'bail|required|int';
            $data['medicines.*.duration'] = 'bail|required|int';
            $data['medicines.*.description'] = 'bail|required|string|max:255';

        }

        return $data;
    }


}
