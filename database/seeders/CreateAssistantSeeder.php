<?php

namespace Database\Seeders;

use App\Models\Assistant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateAssistantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->addAssistant();
    }

    public function addAssistant()
    {
        Assistant::create([
            'name' => 'assistant',
            'ssd' => '22222222222222',
            'email' => 'assistant@gmail.com',
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
