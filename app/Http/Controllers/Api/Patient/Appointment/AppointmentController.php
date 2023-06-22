<?php

namespace App\Http\Controllers\Api\Patient\Appointment;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Appointment\AppointmentRequest;
use App\Interfaces\Api\Patient\Appointment\AppointmentInterface;

class AppointmentController extends Controller
{

    public $Appointment;

    public function __construct(AppointmentInterface $Appointment)
    {
        $this->Appointment = $Appointment;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() // Get Appointments
    {
        return $this->Appointment->index();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)  //Add Appointment
    {
        return $this->Appointment->store($request);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AppointmentRequest $request, $appointment_id) //Update Appointment
    {
        return $this->Appointment->update($request, $appointment_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($appointment_id) //Delete Appointment
    {
        return $this->Appointment->destroy($appointment_id);
    }
}
