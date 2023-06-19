<?php

namespace App\Http\Controllers\Api\Doctor\Clinic;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Clinic\CreateClinicRequest;
use App\Http\Requests\Api\Clinic\DeleteClinicAssistantRequest;
use App\Http\Requests\Api\Clinic\DeleteClinicImageRequest;
use App\Http\Requests\Api\Clinic\GetClinicAssistantRequest;
use App\Http\Requests\Api\Clinic\StatusClinicRequest;
use App\Http\Requests\Api\Clinic\UpdateClinicAssistantRequest;
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

    public function updateClinic(UpdateClinicRequest $request) //Update Clinic
    {
        return $this->Clinic->updateClinic($request);
    }

    public function statusClinic(StatusClinicRequest $request) //Update Clinic Status
    {
        return $this->Clinic->statusClinic($request);
    }

    public function updateClinicLogo(UpdateClinicImageRequest $request) //Update Logo
    {
        return $this->Clinic->updateClinicLogo($request);
    }

    public function deleteClinicLogo(DeleteClinicImageRequest $request) //Delete Logo
    {
        return $this->Clinic->deleteClinicLogo($request);
    }

    public function updateClinicAssistant(UpdateClinicAssistantRequest $request) // Update Assistant
    {
        return $this->Clinic->updateClinicAssistant($request);
    }

    public function getClinicAssistantRequests(GetClinicAssistantRequest $request) //Get Clinic Assistant Request
    {
        return $this->Clinic->getClinicAssistantRequests($request);
    }

    public function deleteClinicAssistantRequest(DeleteClinicAssistantRequest $request) // Delete Clinic Assistant Request
    {
        return $this->Clinic->deleteClinicAssistantRequest($request);
    }

    public function getClinicAssistant(GetClinicAssistantRequest $request)  // Get Assistant
    {
        return $this->Clinic->getClinicAssistant($request);
    }

    public function deleteClinicAssistant(GetClinicAssistantRequest $request) // Delete Clinic Assistant
    {
        return $this->Clinic->deleteClinicAssistant($request);
    }

}
