<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Requests\Api\Auth\resetPasswordRequest;
use App\Http\Requests\Api\Auth\SendEmailVerificationCode;
use App\Http\Requests\Api\Auth\UpdateImageRequest;
use App\Http\Requests\Api\Auth\UpdatePasswordRequest;
use App\Http\Requests\Api\Auth\UpdateProfileRequest;
use App\Interfaces\Api\Auth\AuthInterface;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public $Auth;

    public function __construct(AuthInterface $Auth)
    {
        $this->Auth = $Auth;
    }

    public function register(RegisterRequest $request) // Register
    {
        return $this->Auth->register($request);
    }

    public function login(LoginRequest $request,$type) // login
    {
        return $this->Auth->login($request,$type);
    }

    public function profile($type) // Get Profile
    {
        return $this->Auth->profile($type);
    }

    public function logout() // Logout
    {
        return $this->Auth->logout();
    }

    public function refresh() // Refresh token
    {
        return $this->Auth->refresh();
    }

    public function updateProfileImage(UpdateImageRequest $request,$type) // Update Profile Image
    {
        return $this->Auth->updateProfileImage($request,$type);
    }

    public function deleteProfileImage() // Delete Profile Image
    {
        return $this->Auth->deleteProfileImage();
    }

    public function updatePassword(UpdatePasswordRequest $request) // Update Password
    {
        return $this->Auth->updatePassword($request);
    }

    public function updateProfile(UpdateProfileRequest $request,$type) // Update Profile
    {
        return $this->Auth->updateProfile($request,$type);
    }

    public function resetPassword(resetPasswordRequest $request,$type) // Reset Password
    {
        return $this->Auth->resetPassword($request,$type);
    }

    public function getVideo($type) //Get Videos
    {
        return $this->Auth->getVideo($type);
    }

    public function getSpecialists() //Get Specialists
    {
        return $this->Auth->getSpecialists();
    }

    public function getGenders() // Get Genders
    {
        return $this->Auth->getGenders();
    }

    public function getGovernorates() // Get Governorates
    {
        return $this->Auth->getGovernorates();
    }

    public function sendEmailOtpVerification(SendEmailVerificationCode $request) // Send Email Verification Code
    {
        return $this->Auth->sendEmailOtpVerification($request);
    }

    public function sendPhoneOtpVerification(Request $request) // Send Phone Verification Code
    {
        return $this->Auth->sendEmailOtpVerification($request);
    }

}
