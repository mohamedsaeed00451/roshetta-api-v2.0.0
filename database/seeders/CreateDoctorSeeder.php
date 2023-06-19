<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateDoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->AddDoctor();
    }

    public function AddDoctor()
    {
        Doctor::create([
            'name' => 'doctor',
            'ssd' => '33333333333333',
            'email' => 'doctor@gmail.com',
            'phone' => '1000000000',
            'gender_id' => 1,
            'birth_date' => '2000-01-01',
            'governorate_id' => 1,
            'specialist_id' => 1,
            'brief' => 'دكتور حاضل على مش عارف ايه وبعرف اعمل كذا وكذا',
            'email_isActive' => true,
            'account_isActive' => true,
            'account_enable' => true,
            'account_run' => true,
            'image' => 'default/0ece90fcb9939d35846p.png',
            'password' => Hash::make(12345678)
        ]);
    }
}
