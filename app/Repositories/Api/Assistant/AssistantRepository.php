<?php

namespace App\Repositories\Api\Assistant;

use App\Http\Resources\Api\Assistant\GetClinicsAppointmentResource;
use App\Http\Resources\Api\Assistant\GetClinicsResource;
use App\Http\Resources\Api\Assistant\TotalAppointmentsResource;
use App\Interfaces\Api\Assistant\AssistantInterface;
use App\Models\Clinic;
use App\Traits\GeneralTrait;

class AssistantRepository implements AssistantInterface
{
    use GeneralTrait;

    public function getAssistantClinicRequests()
    {
        // TODO: Implement getAssistantClinicRequests() method.

        try {

            $assistantRequests = auth()->user()->clinicRequests;
            if ($assistantRequests->count() < 1)
                return $this->responseMessage(204, true, __('messages_trans.no_data'));

            $clinics_ids = $assistantRequests->pluck('clinic_id')->toArray();
            $clinics = Clinic::whereIn('id', $clinics_ids)->get();

            if (!$clinics)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $data = [];
            foreach ($assistantRequests as $assistantRequest) {
                foreach ($clinics as $clinic) {
                    if ($clinic->id == $assistantRequest->clinic_id) {
                        array_push($data, [
                            'id' => $assistantRequest->id,
                            'date' => getDateTimeFormat($assistantRequest->created_at),
                            'clinic' => new GetClinicsResource($clinic),
                        ]);
                    }
                }
            }

            return $this->responseMessage(200, true, __('messages_trans.success'), $data);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function acceptClinicRequest($request_id)
    {
        // TODO: Implement acceptClinicRequest() method.

        try {

            $checkRequest = auth()->user()->clinicRequests()->where('id', $request_id)->first();
            if (!$checkRequest)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            if (auth()->user()->clinics()->count() >= 2)
                return $this->responseMessage(400, false, __('messages_trans.max_assistant_clinic'));

            $addAssistantToClinic = Clinic::find($checkRequest->clinic_id);

            if (!$addAssistantToClinic)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            if ($addAssistantToClinic->assistant_id != null)
                return $this->responseMessage(400, false, __('messages_trans.clinic_found_assistant'));

            $addAssistantToClinic->assistant_id = auth()->user()->id;
            $addAssistantToClinic->save();

            $checkRequest->delete();

            return $this->responseMessage(200, true, __('messages_trans.join_clinic_success'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getAssistantClinics()
    {
        // TODO: Implement getAssistantClinics() method.

        try {

            $clinics = auth()->user()->clinics;
            if (!$clinics)
                return $this->responseMessage(204, true, __('messages_trans.no_date'));

            $clinics = GetClinicsResource::collection($clinics);

            return $this->responseMessage(200, true, __('messages_trans.success'), $clinics);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getClinicAppointments($clinic_id)
    {
        // TODO: Implement getClinicAppointments() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $appointments = $clinic->appointments()->paginate(PAGINATION);

            foreach ($appointments as $appoint) {
                $appoint->created_date = getDateTimeFormat($appoint->created_at);
                $appoint->patient = new GetClinicsAppointmentResource($appoint->appointmentPatient);
                unset($appoint->appointmentPatient);
            }

            $data = [
                'total' => new TotalAppointmentsResource($clinic),
                'appointments' => $appointments
            ];

            return $this->responseMessage(200, true, __('messages_trans.success'), $data);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function changeAppointmentStatus($clinic_id, $appointment_id)
    {
        // TODO: Implement changeAppointmentStatus() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $appointment = $clinic->appointments()->where('id', $appointment_id)->first();
            if (!$appointment)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            if ($appointment->status != '0')
                return $this->responseMessage(400, false, __('messages_trans.change_appoint_status_failed'));

            $appointment->status = '1';
            $appointment->save();

            $appointment->updated_date = getDateTimeFormat($appointment->updated_at);
            $appointment->patient = new GetClinicsAppointmentResource($appointment->appointmentPatient);
            unset($appointment->appointmentPatient);

            return $this->responseMessage(201, true, __('messages_trans.change_appoint_status_success'), $appointment);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }
}
