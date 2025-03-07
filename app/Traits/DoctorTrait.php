<?php

namespace App\Traits;

trait DoctorTrait
{
    public function getClinic($doctor,$clinic_id)
    {
        $clinic = $doctor->clinics()
            ->where('id',$clinic_id)
            ->where('account_enable',1)
            ->where('account_isActive',1)
            ->first();
        if (!$clinic)
            return false;

        return $clinic;
    }
}
