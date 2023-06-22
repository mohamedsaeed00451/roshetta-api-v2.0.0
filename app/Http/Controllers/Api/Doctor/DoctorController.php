<?php

namespace App\Http\Controllers\Api\Doctor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Doctor\GetClinicsResource;
use App\Models\Assistant;
use App\Models\Doctor;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    use GeneralTrait;
    public function getClinics()
    {
        $clinics = auth()->user()->clinics;
        $clinics = GetClinicsResource::collection($clinics);
        return $this->responseMessage(200, true, __('messages_trans.success'),$clinics);
    }

    public function getAssistants()
    {
        $assistants = Assistant::where('account_isActive', 1)
            ->where('account_enable', 1)
            ->paginate(PAGINATION);

        $enableAssistant = $assistants->count();
        foreach ($assistants as $assistant) {
            $assistant->image = $this->getPath('profile',$assistant->image);
            $assistant->enable_to_worke = 1;
            $assistant->my_assistant = 0;
            if ($assistant->clinics()->count() >= 2 || $assistant->clinicRequests()->count() >= 2) {
                if (in_array($assistant->id,auth()->user()->clinics()->pluck('assistant_id')->toArray())) {
                    $assistant->my_assistant = 1;
                }
                $assistant->enable_to_worke = 0;
                $enableAssistant -= 1;
            }

            unset($assistant->ssd,$assistant->email,$assistant->email_isActive,$assistant->account_isActive,$assistant->account_enable);

        }

        $data = [
            'total' => [
                'count_all' => Assistant::where('account_isActive', 1)->where('account_enable', 1)->count(),
                'count_enable_in_page' => $enableAssistant
            ],
            'clinics' => $assistants
        ];



        return $this->responseMessage(200, true, __('messages_trans.success'),$data);
    }



}
