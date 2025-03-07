<?php

namespace App\Interfaces\Api\Assistant;

interface AssistantInterface
{
    public function getAssistantClinicRequests(); //Get Assistant Clinic Requests

    public function acceptClinicRequest($request_id); //Accept Clinic Request

    public function getAssistantClinics(); // Get Assistant Clinics

    public function getClinicAppointments($clinic_id); // Get Clinic Appointments

    public function changeAppointmentStatus($clinic_id,$appointment_id); // Change Appointment Status
}
