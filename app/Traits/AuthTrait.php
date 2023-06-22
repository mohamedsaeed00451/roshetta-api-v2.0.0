<?php

namespace App\Traits;

use App\Models\Admin;
use App\Models\Assistant;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Pharmacist;
use App\Models\Pharmacy;
use NumberFormatter;

trait AuthTrait
{
    public function getModel($type)
    {
        if ($type == 'admin') {
            $model = new Admin();
        }

        if ($type == 'doctor') {
            $model = new Doctor();
        }

        if ($type == 'patient') {
            $model = new Patient();
        }

        if ($type == 'pharmacist') {
            $model = new Pharmacist();
        }

        if ($type == 'assistant') {
            $model = new Assistant();
        }

        if ($type == 'clinic') {
            $model = new Clinic();
        }

        if ($type == 'pharmacy') {
            $model = new Pharmacy();
        }

        return $model;
    }

    public function getLangLocal()
    {
        return app()->getLocale();
    }

    public function getSpecialist($id,$type)
    {
        $specialist = $this->getModel($type)->find($id)->specialist()->select('name_' . $this->getLangLocal() . ' as name')->first();
        return $specialist['name'];
    }

    public function getUserGender($user_id, $type)
    {
        $gender = $this->getModel($type)->find($user_id)->gender()->select('name_' . $this->getLangLocal() . ' as gender')->get();
        return $gender[0]['gender'];
    }

    public function getGovernorate($id, $type)
    {
        $governorate = $this->getModel($type)->find($id)->governorate()->select('name_' . $this->getLangLocal() . ' as governorate')->get();
        return $governorate[0]['governorate'];
    }

    public function getImageType($gender)
    {
        $image = 'default/0ece90fcb9939d35846m.png';
        if ($gender == '1')
            $image = 'default/0ece90fcb9939d35846p.png';

        return $image;
    }

    public function calculateAge($birth_date)
    {
        $data = [
            [
                'year_ar' => 'سنة',
                'year_en' => 'year'
            ],
            [
                'month_ar' => 'شهر',
                'month_en' => 'month'
            ],
            [
                'day_ar' => 'يوم',
                'day_en' => 'day'
            ]
        ];

        $birthDate = new \DateTime($birth_date);
        $curentDate = new \DateTime();
        $age = $curentDate->diff($birthDate);

        $year = $this->numberFormater($age->format('%y'));
        $month = $this->numberFormater($age->format('%m'));
        $day = $this->numberFormater($age->format('%d'));

        return $age->format($year . ' ' . $data[0]['year_' . $this->getLangLocal()] . ' ' . $month . ' ' . $data[1]['month_' . $this->getLangLocal()] . ' ' . $day . ' ' . $data[2]['day_' . $this->getLangLocal()] . '');
    }

    public function numberFormater($number)
    {
        $formeter = NumberFormatter::create($this->getLangLocal(), NumberFormatter::DECIMAL);
        $formeter->setTextAttribute(NumberFormatter::DEFAULT_RULESET, '%spellout-numbering');
        return $formeter->format($number);
    }

}
