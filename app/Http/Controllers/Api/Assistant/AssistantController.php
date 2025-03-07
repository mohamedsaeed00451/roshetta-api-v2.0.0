<?php

namespace App\Http\Controllers\Api\Assistant;

use App\Http\Controllers\Controller;
use App\Interfaces\Api\Assistant\AssistantInterface;

class AssistantController extends Controller
{

    public $Assistant;

    public function __construct(AssistantInterface $Assistant)
    {
        $this->Assistant = $Assistant;
    }

    public function getAssistantClinicRequests() //Get Assistant Clinic Requests
    {
        return $this->Assistant->getAssistantClinicRequests();
    }

    public function acceptClinicRequest($request_id) //Accept Clinic Request
    {
        return $this->Assistant->acceptClinicRequest($request_id);
    }

    public function getAssistantClinics() // Get Assistant Clinics
    {
        return $this->Assistant->getAssistantClinics();
    }

    public function getClinicAppointments($clinic_id) // Get Clinic Appointments
    {
        return $this->Assistant->getClinicAppointments($clinic_id);
    }

    public function changeAppointmentStatus($clinic_id,$appointment_id) // Change Appointment Status
    {
        return $this->Assistant->changeAppointmentStatus($clinic_id,$appointment_id);
    }

}


