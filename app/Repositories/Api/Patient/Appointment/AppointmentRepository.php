<?php

namespace App\Repositories\Api\Patient\Appointment;

use App\Http\Resources\Api\patient\GetAppointmentResource;
use App\Interfaces\Api\Patient\Appointment\AppointmentInterface;
use App\Models\Appointment;
use App\Traits\GeneralTrait;

class AppointmentRepository implements AppointmentInterface
{

    use GeneralTrait;

    public function index()
    {
        // TODO: Implement index() method.

        try {

            $appointments = auth()->user()->appointments()->paginate(PAGINATION);
            if ($appointments->count() < 1)
                return $this->responseMessage(204, true, __('messages_trans.no_data'));

            foreach ($appointments as $appoint) {
                $appoint->clinic = new GetAppointmentResource($appoint->appointmentClinic);
                unset($appoint->appointmentClinic);
            }

            $data = [
                'total' => [
                    'count_all' => auth()->user()->appointments()->count(),
                    'count_waiting' => auth()->user()->appointments()->where('status', 0)->count(),
                    'count_in_doctor' => auth()->user()->appointments()->where('status', 1)->count(),
                    'count_done' => auth()->user()->appointments()->where('status', 2)->count()
                ],
                'appointments' => $appointments
            ];

            return $this->responseMessage(200, true, __('messages_trans.success'), $data);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function store($request)
    {
        // TODO: Implement store() method.

        try {

            $checkAppoint = auth()->user()->appointments()
                ->where('clinic_id', $request->clinic_id)
                ->where('status', 0)
                ->first();

            if ($checkAppoint) {

                $checkAppoint->clinic = new GetAppointmentResource($checkAppoint->appointmentClinic);
                unset($checkAppoint->appointmentClinic);
                return $this->responseMessage(400, true, __('messages_trans.appoint_exists'), $checkAppoint);

            }

            $checkAppointDay = auth()->user()->appointments()
                ->where('date', $request->date)
                ->where('status', 0)
                ->get();

            if ($checkAppointDay->count() >= 3) {

                foreach ($checkAppointDay as $appoint) {
                    $appoint->clinic = new GetAppointmentResource($appoint->appointmentClinic);
                    unset($appoint->appointmentClinic);
                }
                return $this->responseMessage(400, true, __('messages_trans.max_appoint'), $checkAppointDay);

            }

            $appointment = Appointment::create([
                'date' => $request->date,
                'patient_id' => auth()->user()->id,
                'clinic_id' => $request->clinic_id
            ]);

            if (!$appointment)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $appointment = Appointment::find($appointment->id);
            $appointment->clinic = new GetAppointmentResource($appointment->appointmentClinic);
            unset($appointment->appointmentClinic);

            return $this->responseMessage(201, true, __('messages_trans.add_appoint'), $appointment);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function update($request, $appointment_id)
    {
        // TODO: Implement update() method.

        try {

            $appointment = auth()->user()->appointments()
                ->where('id', $appointment_id)
                ->where('status', 0)
                ->first();

            if (!$appointment)
                return $this->responseMessage(400, true, __('messages_trans.error'));

            $appointment->date = $request->date;
            $appointment->save();

            $appointment->clinic = new GetAppointmentResource($appointment->appointmentClinic);
            unset($appointment->appointmentClinic);

            return $this->responseMessage(201, true, __('messages_trans.update_appoint'), $appointment);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function destroy($appointment_id)
    {
        // TODO: Implement destroy() method.

        try {

            $appointment = auth()->user()->appointments()
                ->where('id', $appointment_id)
                ->where('status', 0)
                ->first();

            if (!$appointment)
                return $this->responseMessage(400, true, __('messages_trans.error'));

            $appointment->delete();

            return $this->responseMessage(201, true, __('messages_trans.delete_appoint'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.delete_appoint'));
        }

    }
}
