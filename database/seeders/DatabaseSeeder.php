<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CreateSpecialistsSeeder::class);
        $this->call(CreateGenderSeeder::class);
        $this->call(CreateGovernorateSeeder::class);
        $this->call(CreateAdminSeeder::class);
        $this->call(CreateAssistantSeeder::class);
        $this->call(CreateDoctorSeeder::class);
        $this->call(CreatePatientSeeder::class);
        $this->call(CreatePharmacistSeeder::class);
        $this->call(CreateVideosSeeder::class);
        $this->call(CreateClinicSeeder::class);
        $this->call(CreatePharmacySeeder::class);

    }
}
