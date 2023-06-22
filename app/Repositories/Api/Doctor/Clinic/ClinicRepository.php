<?php

namespace App\Repositories\Api\Doctor\Clinic;

use App\Interfaces\Api\Doctor\Clinic\ClinicInterface;
use App\Models\Assistant;
use App\Models\AssistantClinicRequest;
use App\Models\Clinic;
use App\Traits\GeneralTrait;
use Illuminate\Support\Str;

class ClinicRepository implements ClinicInterface
{
    use GeneralTrait;
    public function addClinic($request)
    {
        // TODO: Implement addClinic() method.

        try {

            if (auth()->user()->clinic()->count() >= 2) // check Doctor Clinic Number max 2 clinic
                return $this->responseMessage(400, false, __('messages_trans.clinic_number_err'));

            $serial = Str::random(10); //Create Unique Serial
            $existingSerials = Clinic::pluck('serial')->toArray();
            while (in_array($serial, $existingSerials)) {
                $serial = Str::random(10);
            }

            $clinic = Clinic::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'governorate_id' => $request->governorate_id,
                'specialist_id' => $request->specialist_id,
                'logo' => 'default/c565d293abcd20a54b02.jpg',
                'serial' => $serial,
                'price' => $request->price,
                'start_working' => $request->start_working,
                'end_working' => $request->end_working,
                'address' => $request->address,
                'owner_id' => auth()->user()->id
            ]);

            if (!$clinic)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $clinic = Clinic::find($clinic->id);
            $clinic->governorate = $this->getGovernorate($clinic->id, 'clinic');
            $clinic->specialist = $this->getSpecialist($clinic->id, 'clinic');
            $clinic->logo = $this->getPath('place', $clinic->logo);
            $clinic->team = [
                'doctor' => $this->getDoctor($clinic->id),
                'assistant' => $this->getAssistant($clinic->id)
            ];

            return $this->responseMessage(201, true, __('messages_trans.add_clinic'), $clinic);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function updateClinic($request,$clinic_id)
    {
        // TODO: Implement updateClinic() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $clinic->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'governorate_id' => $request->governorate_id,
                'specialist_id' => $request->specialist_id,
                'price' => $request->price,
                'start_working' => $request->start_working,
                'end_working' => $request->end_working,
                'address' => $request->address,
            ]);

            $clinic->governorate = $this->getGovernorate($clinic->id, 'clinic');
            $clinic->specialist = $this->getSpecialist($clinic->id, 'clinic');
            $clinic->logo = $this->getPath('place', $clinic->logo);
            $clinic->team = [
                'doctor' => $this->getDoctor($clinic->id),
                'assistant' => $this->getAssistant($clinic->id)
            ];

            return $this->responseMessage(201, true, __('messages_trans.update'), $clinic);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function statusClinic($request,$clinic_id)
    {
        // TODO: Implement statusClinic() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $status = false;
            if ($request->status == 1) {
                $status = true;
            }
            $clinic->account_run = $status;
            $clinic->save();

            return $this->responseMessage(201, true, __('messages_trans.success'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function updateClinicLogo($request,$clinic_id)
    {
        // TODO: Implement updateClinicLogo() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $this->deleteImage('images/place/', $clinic->logo); //Delete Old Image
            $add_image = $this->addImage('images/place/clinic/' . $clinic->serial, $request->file('logo'));

            if (!$add_image)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $clinic->logo = 'clinic/' . $clinic->serial . '/' . $add_image;
            $clinic->save();

            $logo = $this->getPath('place', $clinic->logo);

            return $this->responseMessage(201, true, __('messages_trans.update_image'), ['logo' => $logo]);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function deleteClinicLogo($clinic_id)
    {
        // TODO: Implement deleteClinicLogo() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $this->deleteImage('images/place/', $clinic->logo);  //Delete Old Image
            $clinic->logo = 'default/c565d293abcd20a54b02.jpg';
            $clinic->save();
            $logo = $this->getPath('place', $clinic->logo);

            return $this->responseMessage(201, true, __('messages_trans.delete_image'), ['logo' => $logo]);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function updateClinicAssistant($clinic_id,$assistant_id)
    {
        // TODO: Implement updateClinicAssistant() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $assistant = Assistant::find($assistant_id);
            if (!$assistant)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            if ($check = $this->getAssistantClinicRquests($clinic, $assistant))
                return $check;

            $addRequest = AssistantClinicRequest::create([
                'clinic_id' => $clinic->id,
                'assistant_id' => $assistant->id
            ]);

            if (!$addRequest)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $data = [
                'id' => $addRequest->id,
                'date' => getDateTimeFormat($addRequest->created_at),
                'assistant' => [
                    'id' => $assistant->id,
                    'name' => $assistant->name,
                    'phone' => $assistant->phone,
                    'image' => $this->getPath('profile', $assistant->image)
                ],
            ];

            return $this->responseMessage(201, true, __('messages_trans.update_assistant'), $data);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getClinicAssistantRequests($clinic_id)
    {
        // TODO: Implement getClinicAssistantRequests() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $getClinicRequest = $clinic->clinicRequests()->first();

            if (!$getClinicRequest)
                return $this->responseMessage(400, false, __('messages_trans.no_data'));

            $assistant = Assistant::find($getClinicRequest['assistant_id']);

            if (!$assistant)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $data = [
                'id' => $getClinicRequest->id,
                'date' => getDateTimeFormat($getClinicRequest->created_at),
                'assistant' => [
                    'id' => $assistant->id,
                    'name' => $assistant->name,
                    'phone' => $assistant->phone,
                    'image' => $this->getPath('profile', $assistant->image)
                ],
            ];

            return $this->responseMessage(200, true, __('messages_trans.success'), $data);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function deleteClinicAssistantRequest($clinic_id,$request_id)
    {
        // TODO: Implement deleteClinicAssistantRequest() method.

        try {

            if (!$this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $delete = AssistantClinicRequest::where('id', $request_id)
                ->where('clinic_id', $clinic_id)
                ->delete();

            if (!$delete)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            return $this->responseMessage(201, true, __('messages_trans.delete_assistant_request'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getClinicAssistant($clinic_id)
    {
        // TODO: Implement getClinicAssistant() method.

        try {

            if (!$this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $assistant = $this->getAssistant($clinic_id);

            return $this->responseMessage(200, true, __('messages_trans.success'),$assistant);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function deleteClinicAssistant($clinic_id)
    {
        // TODO: Implement deleteClinicAssistant() method.

        try {

            if (!$clinic = $this->getClinic(auth()->user(), $clinic_id))
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $clinic->assistant_id = null;
            $clinic->save();

            return $this->responseMessage(201, true, __('messages_trans.delete_assistant'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }
}
