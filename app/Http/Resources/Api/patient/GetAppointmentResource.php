<?php

namespace App\Http\Resources\Api\patient;

use App\Traits\UrlTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetAppointmentResource extends JsonResource
{
    use UrlTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'logo' => $this->getPath('place',$this->logo),
            'start_working' => $this->start_working,
            'end_working' => $this->end_working
        ];
    }
}
