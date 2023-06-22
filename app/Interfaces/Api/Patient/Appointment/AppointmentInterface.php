<?php

namespace App\Interfaces\Api\Patient\Appointment;

interface AppointmentInterface
{
    public function index(); // Get Appointments

    public function store($request); //Add Appointment

    public function update($request, $appointment_id); //Update Appointment

    public function destroy($appointment_id); //Delete Appointment
}
