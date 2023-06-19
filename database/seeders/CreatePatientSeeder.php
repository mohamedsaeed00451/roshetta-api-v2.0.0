<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreatePatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->AddPatient();
    }

    public function AddPatient()
    {
        Patient::create([
            'name' => 'patient',
            'ssd' => '44444444444444',
            'email' => 'patient@gmail.com',
            'phone' => '1000000000',
            'gender_id' => 1,
            'birth_date' => '2000-01-01',
            'governorate_id' => 1,
            'weight' => 60,
            'height' => 160,
            'email_isActive' => true,
            'account_isActive' => true,
            'account_enable' => true,
            'account_run' => true,
            'image' => 'default/0ece90fcb9939d35846p.png',
            'password' => Hash::make(12345678)
        ]);
    }
}
