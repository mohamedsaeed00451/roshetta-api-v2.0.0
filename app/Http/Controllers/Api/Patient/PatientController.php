<?php

namespace App\Http\Controllers\Api\Patient;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Traits\GeneralTrait;

class PatientController extends Controller
{
    use GeneralTrait;

    public function getClinics()
    {
        try {

            $clinics = Clinic::where('account_isActive', 1)
                ->where('account_enable', 1)
                ->paginate(PAGINATION);

            if ($clinics->count() < 1)
                return $this->responseMessage(204, true, __('messages_trans.no_data'));

            $countAll = Clinic::where('account_isActive', 1)->where('account_enable', 1)->count();
            $countEnable = $clinics->count();
            $patientClinicAppointments = auth()->user()->appointments;
            $patientClinicAppointment_ids = $patientClinicAppointments->pluck('clinic_id')->toArray();

            foreach ($clinics as $clinic) {

                $clinic->governorate = $this->getGovernorate($clinic->id, 'clinic');
                $clinic->specialist = $this->getSpecialist($clinic->id, 'clinic');
                $clinic->logo = $this->getPath('place', $clinic->logo);
                $clinic->enableAddAppointment = 1;
                $clinic->appointmentDate = null;

                if (in_array($clinic->id, $patientClinicAppointment_ids)) {
                    foreach ($patientClinicAppointments as $patientClinicAppointment) {
                        if ($clinic->id == $patientClinicAppointment->clinic_id) {
                            if ($patientClinicAppointment->status == 0) {
                                $clinic->enableAddAppointment = $patientClinicAppointment->status;
                                $clinic->appointmentDate = $patientClinicAppointment->date;
                                $countEnable -= 1;
                            }
                        }
                    }
                }

                unset($clinic->account_isActive,$clinic->account_enable);

            }

            $data = [
                'total' => [
                    'count_all' => $countAll,
                    'count_enable_in_page' => $countEnable
                ],
                'clinics' => $clinics
            ];


            return $this->responseMessage(200, true, __('messages_trans.success'), $data);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }
    }
}
