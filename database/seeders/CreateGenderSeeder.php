<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateGenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name_ar' => 'ذكر',
                'name_en' => 'male',
            ],
            [
                'name_ar' => 'أنثى',
                'name_en' => 'female',
            ]
        ];

        foreach ($data as $gender) {
            Gender::create([
                'name_ar' => $gender['name_ar'],
                'name_en' => $gender['name_en'],
            ]);
        }
    }
}
