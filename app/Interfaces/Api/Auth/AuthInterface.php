<?php

namespace App\Interfaces\Api\Auth;

interface AuthInterface
{
    public function register($request); // Register

    public function login($request,$type); // login

    public function profile($type); // Get Profile

    public function logout(); // Logout

    public function refresh(); // Refresh token

    public function updateProfileImage($request,$type); // Update Profile Image

    public function deleteProfileImage(); // Delete Profile Image

    public function updatePassword($request); // Update Password

    public function updateProfile($request,$type); // Update Profile

    public function resetPassword($request,$type); // Reset Password

    public function getVideo($type); //Get Videos

    public function getSpecialists(); //Get Specialists

    public function getGenders(); // Get Genders

    public function getGovernorates(); // Get Governorates

    public function sendEmailOtpVerification($request); // Send Email Verification Code

    public function sendPhoneOtpVerification($request); // Send Phone Verification Code
}
