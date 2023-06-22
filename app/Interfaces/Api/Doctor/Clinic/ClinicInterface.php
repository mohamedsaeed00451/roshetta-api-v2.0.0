<?php

namespace App\Interfaces\Api\Doctor\Clinic;

interface ClinicInterface
{
    public function addClinic($request); //Add Clinic

    public function updateClinic($request,$clinic_id); //Update Clinic

    public function statusClinic($request,$clinic_id); //Update Clinic Status

    public function updateClinicLogo($request,$clinic_id); //Update Logo

    public function deleteClinicLogo($clinic_id); //Delete Logo

    public function updateClinicAssistant($clinic_id,$assistant_id); // Update Assistant

    public function getClinicAssistantRequests($clinic_id); //Get Clinic Assistant Request

    public function deleteClinicAssistantRequest($clinic_id,$request_id); // Delete Clinic Assistant Request

    public function getClinicAssistant($clinic_id); // Get Assistant

    public function deleteClinicAssistant($clinic_id); // Delete Clinic Assistant
}
