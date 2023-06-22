<?php

namespace App\Providers\Api;

use App\Interfaces\Api\Auth\AuthInterface;
use App\Interfaces\Api\Doctor\Clinic\ClinicInterface;
use App\Interfaces\Api\Patient\Appointment\AppointmentInterface;
use App\Repositories\Api\Auth\AuthRepository;
use App\Repositories\Api\Doctor\Clinic\ClinicRepository;
use App\Repositories\Api\Patient\Appointment\AppointmentRepository;
use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //****************** Auth ******************//
        $this->app->bind(AuthInterface::class,AuthRepository::class);
        //****************** Clinic ******************//
        $this->app->bind(ClinicInterface::class,ClinicRepository::class);
        //****************** Appointment ******************//
        $this->app->bind(AppointmentInterface::class,AppointmentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
