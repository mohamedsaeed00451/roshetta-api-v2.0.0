<?php

namespace App\Providers\Api;

use App\Interfaces\Api\Auth\AuthInterface;
use App\Interfaces\Api\Doctor\Clinic\ClinicInterface;
use App\Repositories\Api\Auth\AuthRepository;
use App\Repositories\Api\Doctor\Clinic\ClinicRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
