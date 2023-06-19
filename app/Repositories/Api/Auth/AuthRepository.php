<?php

namespace App\Repositories\Api\Auth;

use App\Interfaces\Api\Auth\AuthInterface;
use App\Mail\Api\Auth\LoginAlertEmail;
use App\Mail\Api\Auth\RegisterEmail;
use App\Mail\Api\Auth\ResetPasswordEmail;
use App\Models\Gender;
use App\Models\Governorate;
use App\Models\Specialist;
use App\Models\Video;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Otp;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthRepository implements AuthInterface
{

    use GeneralTrait;

    public $otp;

    public function __construct()
    {
        $this->otp = new Otp;
    }

    public function register($request)
    {
        // TODO: Implement register() method.

        try {

            $otpVerify = $this->otp->validate($request->email, $request->email_code);

            if (!$otpVerify->status)
                return $this->responseMessage(401, false, $otpVerify->message);

            $data = [
                'name' => $request->name,
                'ssd' => $request->ssd,
                'email' => $request->email,
                'phone' => $request->phone,
                'gender_id' => $request->gender_id,
                'birth_date' => $request->birth_date,
                'governorate_id' => $request->governorate_id,
                'email_isActive' => true,
                'image' => $this->getImageType($request->gender),
                'password' => Hash::make($request->password)
            ];

            if ($request->type == 'doctor')
                $data['specialist_id'] = $request->specialist_id;

            if ($request->type == 'patient') {
                $data['weight'] = $request->weight;
                $data['height'] = $request->height;
            }

            $register = $this->getModel($request->type)->create($data);

            if (!$register)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $user = $this->getModel($request->type)->find($register->id);

            $token = JWTAuth::fromUser($user);

            if ($request->type == 'doctor')
                $user->specialist = $this->getSpecialist($user->id, $request->type);


            $user->age = $this->calculateAge($user->birth_date);
            $user->governorate = $this->getGovernorate($user->id, $request->type);
            $user->gender = $this->getUserGender($user->id, $request->type);
            $user->join_at = getDateTimeFormat($user->created_at);
            $user->image = $this->getPath('profile', $user->image);
            $user->type = $request->type;
            $user->access_token = $token;
            $user->token_type = 'bearer';
            $user->expires_in = auth()->factory()->getTTL() * 60;

            return $this->responseMessage(200, true, __('messages_trans.register'), $user);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'), $e->getMessage());
        }

    }

    public function login($request)
    {
        // TODO: Implement login() method.

        try {

            $credentials = $request->only(['ssd', 'password']);

            if (!$token = auth($request->type)->attempt($credentials))
                return $this->responseMessage(400, false, __('messages_trans.ssd_password'));

            $user = auth($request->type)->user();

            if ($user->account_enable != 1) // check Acount Is Enable
                return $this->responseMessage(400, false, 'الحساب الخاص بك معطل الرجاء التواصل مع المشرف');

            if ($user->email_isActive != 1)  //check Email Is Active
                return $this->responseMessage(202, false, __('messages_trans.verify'));

            $user->account_run = 1;
            $user->save();

            if ($request->type == 'doctor')
                $user->specialist = $this->getSpecialist($user->id, $request->type);

            $user->age = $this->calculateAge($user->birth_date);
            $user->governorate = $this->getGovernorate($user->id, $request->type);
            $user->gender = $this->getUserGender($user->id, $request->type);
            $user->join_at = getDateTimeFormat($user->created_at);
            $user->image = $this->getPath('profile', $user->image);
            $user->type = $request->type;
            $user->access_token = $token;
            $user->token_type = 'bearer';
            $user->expires_in = auth()->factory()->getTTL() * 60;

            try {
                Mail::to($user->email)->send(new LoginAlertEmail($user->name, $request->type));
            } catch (\Exception $e) {
                //
            }

            return $this->responseMessage(200, true, __('messages_trans.login'), $user);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function profile($request)
    {
        // TODO: Implement profile() method.
        try {

            $user = auth()->user();
            if ($user->specialist_id)
                $user->specialist = $this->getSpecialist($user->id, $request->type);

            $user->age = $this->calculateAge($user->birth_date);
            $user->governorate = $this->getGovernorate($user->id, $request->type);
            $user->gender = $this->getUserGender($user->id, $request->type);
            $user->join_at = getDateTimeFormat($user->created_at);
            $user->image = $this->getPath('profile', $user->image);

            return $this->responseMessage(200, true, __('messages_trans.success'), $user);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function logout()
    {
        // TODO: Implement logout() method.

        try {

            $user = auth()->user();
            $user->account_run = 0;
            $user->save();
            auth()->logout();
            return $this->responseMessage(200, true, __('messages_trans.logout'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function refresh()
    {
        // TODO: Implement refresh() method.

        $data['access_token'] = auth()->refresh();
        $data['token_type'] = 'bearer';
        $data['expires_in'] = auth()->factory()->getTTL() * 60;
        return $this->responseMessage(200, true, __('messages_trans.success'), $data);

    }

    public function updateProfileImage($request)
    {
        // TODO: Implement updateProfileImage() method.

        try {

            $user = auth()->user();
            $this->deleteImage('images/profile/', $user->image); //Delete Old Image
            $add_image = $this->addImage('images/profile/' . $request->type . '/' . $user->email, $request->file('photo'));

            if (!$add_image)
                return $this->responseMessage(400, false, __('messages_trans.error'));

            $user->image = $request->type . '/' . $user->email . '/' . $add_image;
            $user->save();

            $image = $this->getPath('profile', $user->image);

            return $this->responseMessage(201, true, __('messages_trans.update_image'), ['image' => $image]);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function deleteProfileImage()
    {
        // TODO: Implement deleteProfileImage() method.

        try {

            $user = auth()->user();
            $this->deleteImage('images/profile/', $user->image);  //Delete Old Image
            $user->image = $this->getImageType($user->gender);
            $user->save();
            $image = $this->getPath('profile', $user->image);

            return $this->responseMessage(201, true, __('messages_trans.delete_image'), ['image' => $image]);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function updatePassword($request)
    {
        // TODO: Implement updatePassword() method.

        try {

            $user = auth()->user();
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->responseMessage(201, true, __('messages_trans.password'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function updateProfile($request)
    {
        // TODO: Implement updateProfile() method.

        try {

            $user = auth()->user();
            $user->phone = $request->phone;
            $user->governorate_id = $request->governorate_id;
            if ($request->type == 'patient') {
                $user->weight = $request->weight;
                $user->height = $request->height;
            }
            if ($request->type == 'doctor') {
                if ($request->brief != null)
                    $user->brief = $request->brief;
            }
            $user->save();

            if ($request->type == 'doctor') {
                $user->specialist = $this->getDoctorSpecialist($user->id);
            }

            $user->age = $this->calculateAge($user->birth_date);
            $user->governorate = $this->getGovernorate($user->id, $request->type);
            $user->gender = $this->getUserGender($user->id, $request->type);
            $user->image = $this->getPath('profile', $user->image);
            $user->type = $request->type;

            return $this->responseMessage(201, true, __('messages_trans.update'), $user);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function resetPassword($request)
    {
        // TODO: Implement resetPassword() method.

        try {

            $otpVerify = $this->otp->validate($request->email, $request->otp);

            if (!$otpVerify->status)
                return $this->responseMessage(401, false, $otpVerify->message);

            $user = $this->getModel($request->type)->where('email', $request->email)->first();
            $user->password = Hash::make($request->password);
            $user->save();

            return $this->responseMessage(201, true, __('messages_trans.password'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getVideo($request)
    {
        // TODO: Implement getVideo() method.

        try {
            $video = Video::where('type', $request->type)->first();
            $video->video = $this->getPath('video', $video->video);
            return $this->responseMessage(200, true, __('messages_trans.success'), $video);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getSpecialists()
    {
        // TODO: Implement getSpecialists() method.

        try {

            $specialists = Specialist::select('id', 'name_' . $this->getLangLocal() . ' as specialist')->get();
            return $this->responseMessage(200, true, __('messages_trans.success'), $specialists);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getGenders()
    {
        // TODO: Implement getGenders() method.

        try {

            $genders = Gender::select('id', 'name_' . $this->getLangLocal() . ' as gender')->get();
            return $this->responseMessage(200, true, __('messages_trans.success'), $genders);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function getGovernorates()
    {
        // TODO: Implement getGovernorates() method.

        try {

            $governorates = Governorate::select('id', 'name_' . $this->getLangLocal() . ' as governorate')->get();
            return $this->responseMessage(200, true, __('messages_trans.success'), $governorates);

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function sendEmailOtpVerification($request)
    {
        // TODO: Implement sendEmailOtpVerification() method.

        try {

            $otp = $this->otp->generate($request->email, 6, 60);

            if ($request->type == 'register') {
                $send = Mail::to($request->email)->send(new RegisterEmail($otp->token));
            }

            if ($request->type == 'reset_password') {
                $send = Mail::to($request->email)->send(new ResetPasswordEmail($otp->token));
            }

            if (!$send)
                return $this->responseMessage(400, false, __('messages_trans.send_code_failed'));

            return $this->responseMessage(200, true, __('messages_trans.verification'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, __('messages_trans.error'));
        }

    }

    public function sendPhoneOtpVerification($request)
    {
        // TODO: Implement sendPhoneOtpVerification() method.

        try {
            $rules = [
                'phone' => 'bail|required|string'
            ];

            $validation = validator::make($request->all(), $rules);

            if ($validation->fails())
                return $this->responseMessage(400, false, __('messages_trans.error'), ['error' => $validation->messages()]);

            //send code

            return $this->responseMessage(200, true, __('messages_trans.verification'));

        } catch (\Exception $e) {
            return $this->responseMessage(400, false, $e->getMessage());
        }

    }

}
