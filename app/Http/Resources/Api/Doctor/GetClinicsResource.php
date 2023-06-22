<?php

namespace App\Http\Resources\Api\Doctor;

use App\Traits\UrlTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetClinicsResource extends JsonResource
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
            'logo' => $this->getPath('place',$this->logo),
            'start_working' => $this->start_working,
            'end_working' => $this->end_working,
            'account_isActive' => $this->account_isActive,
            'account_enable' => $this->account_enable,
            'account_run' => $this->account_run,
        ];
    }
}
