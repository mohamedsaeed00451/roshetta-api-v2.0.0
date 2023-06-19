<?php

namespace Database\Seeders;

use App\Models\Pharmacist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreatePharmacistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->addPharmacist();
    }

    public function addPharmacist()
    {
        Pharmacist::create([
            'name' => 'pharmacist',
            'ssd' => '55555555555555',
            'email' => 'pharmacist@gmail.com',
            'phone' => '1000000000',
            'gender_id' => 1,
            'birth_date' => '2000-01-01',
            'governorate_id' => 1,
            'email_isActive' => true,
            'account_isActive' => true,
            'account_enable' => true,
            'account_run' => true,
            'image' => 'default/0ece90fcb9939d35846p.png',
            'password' => Hash::make(12345678)
        ]);
    }
}
