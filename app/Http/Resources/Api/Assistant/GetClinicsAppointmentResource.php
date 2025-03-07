<?php

namespace App\Http\Resources\Api\Assistant;

use App\Traits\UrlTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetClinicsAppointmentResource extends JsonResource
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
            'image' => $this->getPath('profile',$this->image),
        ];
    }
}
