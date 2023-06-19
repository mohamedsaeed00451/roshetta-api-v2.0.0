<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateVideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'video' => 'df_video.mp4',
                'type' => 'doctor',
            ],
            [
                'video' => 'df_video.mp4',
                'type' => 'patient',
            ],
            [
                'video' => 'df_video.mp4',
                'type' => 'assistant',
            ],
            [
                'video' => 'df_video.mp4',
                'type' => 'pharmacist',
            ],
        ];

        foreach ($data as $video) {
            Video::create([
                'video' => $video['video'],
                'type' => $video['type'],
            ]);
        }
    }
}
