<?php

namespace App\Http\Resources\Api\Assistant;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TotalAppointmentsResource extends JsonResource
{
    public $clinic;

    public function __construct($clinic)
    {
        $this->clinic = $clinic;
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'all' => [
                'count_all' => $this->clinic->appointments()->count(),
                'count_waiting' => $this->clinic->appointments()->where('status', '0')->count(),
                'count_in_doctor' => $this->clinic->appointments()->where('status', '1')->count(),
                'count_done' => $this->clinic->appointments()->where('status', '2')->count()
            ],

            'today' => [
                'count_all' => $this->clinic->appointments()->where('date', date('Y-m-d'))->count(),
                'count_waiting' => $this->clinic->appointments()->where('date', date('Y-m-d'))->where('status', '0')->count(),
                'count_in_doctor' => $this->clinic->appointments()->where('date', date('Y-m-d'))->where('status', '1')->count(),
                'count_done' => $this->clinic->appointments()->where('date', date('Y-m-d'))->where('status', '2')->count()
            ],
        ];
    }
}
