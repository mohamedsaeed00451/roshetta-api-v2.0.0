<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateClinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clinic::create([
            'name' => 'اول عيادة',
            'phone' => '1010101010',
            'governorate_id' => 1,
            'specialist_id' => 1,
            'account_isActive' => true,
            'account_enable' => true,
            'account_run' => true,
            'logo' => 'default/c565d293abcd20a54b02.jpg',
            'serial' => 'c565d293abcd20a54b02',
            'price' => 120,
            'start_working' => now(),
            'end_working' => now(),
            'address' => 'عنوان العيادة',
            'owner_id' => 1,
            'assistant_id' => 1
        ]);
    }
}
