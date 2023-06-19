<?php

namespace App\Traits;

use App\Models\Clinic;

trait ClinicTrait
{
    public function getAssistant($clinic_id)
    {
        $clinic = Clinic::find($clinic_id);
        $assistant = $clinic->assistant()->select('id', 'name', 'phone', 'image')->first();
        if ($assistant)
            $assistant['image'] = $this->getPath('profile', $assistant['image']);
        return $assistant;

    }

    public function getDoctor($clinic_id)
    {
        $clinic = Clinic::find($clinic_id);
        $doctor = $clinic->doctor()->select('id', 'name', 'phone', 'image')->first();
        if ($doctor)
            $doctor['image'] = $this->getPath('profile', $doctor['image']);
        return $doctor;
    }

    public function getAssistantClinicRquests($clinic, $assistant)
    {
        if ($clinic->assistant_id != null)
            return $this->responseMessage(400, false, __('messages_trans.get_assistant'));

        $clinicRequestsCount = $clinic->clinicRequests()->count();

        if ($clinicRequestsCount > 0)
            return $this->responseMessage(400, false, __('messages_trans.more_request'));

        $assistantRequestsCount = $assistant->clinicRequests()->count();

        if ($assistantRequestsCount >= 2)
            return $this->responseMessage(400, false, __('messages_trans.assistant_more_requests'));

        return false;
    }


}
