<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreatePharmacySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pharmacy::create([
            'name' => 'اول صيدلية',
            'phone' => '2020202020',
            'governorate_id' => 1,
            'account_isActive' => true,
            'account_enable' => true,
            'account_run' => true,
            'logo' => 'default/c565d293abcd20a54b02.jpg',
            'serial' => 'c535k856abcd20a63b78',
            'start_working' => now(),
            'end_working' => now(),
            'address' => 'عنوان الصيدلية',
            'owner_id' => 1,
        ]);
    }
}
