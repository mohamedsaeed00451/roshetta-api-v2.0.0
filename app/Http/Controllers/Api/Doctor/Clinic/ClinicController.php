<?php

namespace App\Http\Controllers\Api\Doctor\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clinic\CreateClinicRequest;
use App\Http\Requests\Api\Clinic\StatusClinicRequest;
use App\Http\Requests\Api\Clinic\UpdateClinicImageRequest;
use App\Http\Requests\Api\Clinic\UpdateClinicRequest;
use App\Interfaces\Api\Doctor\Clinic\ClinicInterface;


class ClinicController extends Controller
{

    public $Clinic;

    public function __construct(ClinicInterface $Clinic)
    {
        $this->Clinic = $Clinic;
    }

    public function addClinic(CreateClinicRequest $request) //Add Clinic
    {
        return $this->Clinic->addClinic($request);
    }

    public function updateClinic(UpdateClinicRequest $request,$clinic_id) //Update Clinic
    {
        return $this->Clinic->updateClinic($request,$clinic_id);
    }

    public function statusClinic(StatusClinicRequest $request,$clinic_id) //Update Clinic Status
    {
        return $this->Clinic->statusClinic($request,$clinic_id);
    }

    public function updateClinicLogo(UpdateClinicImageRequest $request,$clinic_id) //Update Logo
    {
        return $this->Clinic->updateClinicLogo($request,$clinic_id);
    }

    public function deleteClinicLogo($clinic_id) //Delete Logo
    {
        return $this->Clinic->deleteClinicLogo($clinic_id);
    }

    public function updateClinicAssistant($clinic_id,$assistant_id) // Update Assistant
    {
        return $this->Clinic->updateClinicAssistant($clinic_id,$assistant_id);
    }

    public function getClinicAssistantRequests($clinic_id) //Get Clinic Assistant Request
    {
        return $this->Clinic->getClinicAssistantRequests($clinic_id);
    }

    public function deleteClinicAssistantRequest($clinic_id,$request_id) // Delete Clinic Assistant Request
    {
        return $this->Clinic->deleteClinicAssistantRequest($clinic_id,$request_id);
    }

    public function getClinicAssistant($clinic_id)  // Get Assistant
    {
        return $this->Clinic->getClinicAssistant($clinic_id);
    }

    public function deleteClinicAssistant($clinic_id) // Delete Clinic Assistant
    {
        return $this->Clinic->deleteClinicAssistant($clinic_id);
    }

}
