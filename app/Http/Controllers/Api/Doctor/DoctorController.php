<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Doctor\AddPrescriptRequest;
use App\Http\Resources\Api\Assistant\GetClinicsAppointmentResource;
use App\Http\Resources\Api\Assistant\TotalAppointmentsResource;
use App\Http\Resources\Api\Doctor\GetClinicsResource;
use App\Models\Appointment;
use App\Models\Assistant;
use App\Models\Disease;
use App\Models\Medicine;
use App\Models\Prescript;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DoctorController extends Controller
{
    use GeneralTrait;

    public function getClinics()
    {
        try {

            $clinics = auth()->user()->clinics;
            $clinics = GetClinicsResource::collection($clinics);
            return $this->responseMessage(200, true, __('messages_trans.success'), $clinics);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }
    }

    public function getAssistants()
    {
        try {

            $assistants = Assistant::where('account_isActive', 1)
                ->where('account_enable', 1)
                ->paginate(PAGINATION);

            $enableAssistant = $assistants->count();
            foreach ($assistants as $assistant) {
                $assistant->image = $this->getPath('profile', $assistant->image);
                $assistant->enable_to_worke = 1;
                $assistant->my_assistant = 0;
                if ($assistant->clinics()->count() >= 2 || $assistant->clinicRequests()->count() >= 2) {
                    if (in_array($assistant->id, auth()->user()->clinics()->pluck('assistant_id')->toArray())) {
                        $assistant->my_assistant = 1;
                    }
                    $assistant->enable_to_worke = 0;
                    $enableAssistant -= 1;
                }

                unset($assistant->ssd, $assistant->email, $assistant->email_isActive, $assistant->account_isActive, $assistant->account_enable);

            }

            $data = [
                'total' => [
                    'count_all' => Assistant::where('account_isActive', 1)->where('account_enable', 1)->count(),
                    'count_enable_in_page' => $enableAssistant
                ],
                'clinics' => $assistants
            ];

            return $this->responseMessage(200, true, __('messages_trans.success'), $data);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }
    }

    public function getClinicAppointments($clinic_id)
    {
        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $appointments = $clinic->appointments()->whereIn('status', ['1', '2'])->paginate(PAGINATION);

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

    public function addPrescriptMedicines(AddPrescriptRequest $request, $clinic_id)
    {
        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            if ($request->type == 'new') {
                if (!$this->addNewPrescriptMedicines($request, $clinic)) {
                    return $this->responseMessage(400, false, __('messages_trans.error'));
                }
            }

            if ($request->type == 'rediscovery') {
                if (!$this->addOldPrescriptMedicines($request, $clinic)) {
                    return $this->responseMessage(400, false, __('messages_trans.error'));
                }
            }

            return $this->responseMessage(201, true, 'تم وضع الروشتة بنجاح');

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }
    }

    public function addNewPrescriptMedicines($request, $clinic)
    {
        try {
            DB::beginTransaction();
            if (!$patient_id = $this->changeAppointmentStatus($clinic, $request->appointment_id))
                return false;

            $addDisease = Disease::create([
                'disease_name' => $request->name,
                'disease_place' => $request->place,
                'patient_id' => $patient_id,
                'doctor_id' => auth()->user()->id,
                'clinic_id' => $clinic->id
            ]);

            if (!$addDisease)
                return false;

            if (!$prescript_id = $this->addPrescript($request->rediscovery_date, $patient_id, $clinic->id, $addDisease->id))
                return false;

            if (!$this->addMedicine($request->medicines, $prescript_id))
                return false;

            if ($request->rediscovery_date != null) {
                if (!$this->addRediscoveryAppointment($request->rediscovery_date, $patient_id, $clinic->id))
                    return false;
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }

    }

    public function addOldPrescriptMedicines($request,$clinic)
    {
        try {
            DB::beginTransaction();
            if (!$patient_id = $this->changeAppointmentStatus($clinic, $request->appointment_id))
                return false;

            if (!$prescript_id = $this->addPrescript($request->rediscovery_date, $patient_id, $clinic->id, $request->disease_id))
                return false;

            if (!$this->addMedicine($request->medicines, $prescript_id))
                return false;

            if ($request->rediscovery_date != null) {
                if (!$this->addRediscoveryAppointment($request->rediscovery_date, $patient_id, $clinic->id))
                    return false;
            }

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function changeAppointmentStatus($clinic, $appointment_id)
    {
        try {
            $appointment = $clinic->appointments()->where('id', $appointment_id)->first();
            if (!$appointment)
                return false;
            if ($appointment->status != '1')
                return false;
            $appointment->status = '2';
            $appointment->save();
            return $appointment->patient_id;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function addPrescript($rediscovery_date, $patient_id, $clinic_id, $disease_id)
    {
        try {
            $serial = Str::random(10); //Create Unique Serial
            $existingSerials = Prescript::pluck('serial')->toArray();
            while (in_array($serial, $existingSerials)) {
                $serial = Str::random(10);
            }

            $addPrescript = Prescript::create([
                'serial' => $serial,
                'rediscovery_date' => $rediscovery_date,
                'patient_id' => $patient_id,
                'clinic_id' => $clinic_id,
                'doctor_id' => auth()->user()->id,
                'disease_id' => $disease_id
            ]);
            if (!$addPrescript)
                return false;
            return $addPrescript->id;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function addMedicine($medicines, $prescript_id)
    {
        try {
            $addMedicines = Medicine::create([
                'medicines' => json_encode($medicines),
                'prescript_id' => $prescript_id
            ]);
            if (!$addMedicines)
                return false;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function addRediscoveryAppointment($rediscovery_date, $patient_id, $clinic_id)
    {
        try {
            $addAppointment = Appointment::create([
                'date' => $rediscovery_date,
                'patient_id' => $patient_id,
                'clinic_id' => $clinic_id
            ]);
            if (!$addAppointment)
                return false;
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}
