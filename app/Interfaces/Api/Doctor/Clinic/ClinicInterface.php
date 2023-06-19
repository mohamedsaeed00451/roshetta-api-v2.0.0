<?php

namespace App\Interfaces\Api\Doctor\Clinic;

interface ClinicInterface
{
    public function addClinic($request); //Add Clinic

    public function updateClinic($request); //Update Clinic

    public function statusClinic($request); //Update Clinic Status

    public function updateClinicLogo($request); //Update Logo

    public function deleteClinicLogo($request); //Delete Logo

    public function updateClinicAssistant($request); // Update Assistant

    public function getClinicAssistantRequests($request); //Get Clinic Assistant Request

    public function deleteClinicAssistantRequest($request); // Delete Clinic Assistant Request

    public function getClinicAssistant($request); // Get Assistant

    public function deleteClinicAssistant($request); // Delete Clinic Assistant
}
