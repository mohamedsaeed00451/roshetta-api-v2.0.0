<?php

namespace App\Traits;

trait DoctorTrait
{
    public function getClinic($doctor,$clinic_id)
    {
        $clinic = $doctor->clinic()->where('id',$clinic_id)->first();
        if (!$clinic)
            return false;

        return $clinic;
    }
}
