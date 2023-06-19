<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {

            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api.php'));

            Route::middleware('api')
                ->prefix('api/v1/auth')
                ->group(base_path('routes/api/auth.php'));

            Route::middleware('admin')
                ->prefix('api/v1/admin')
                ->group(base_path('routes/api/admin.php'));

            Route::middleware('doctor')
                ->prefix('api/v1/doctor')
                ->group(base_path('routes/api/doctor.php'));

            Route::middleware('patient')
                ->prefix('api/v1/patient')
                ->group(base_path('routes/api/patient.php'));

            Route::middleware('pharmacist')
                ->prefix('api/v1/pharmacist')
                ->group(base_path('routes/api/pharmacist.php'));

            Route::middleware('assistant')
                ->prefix('api/v1/assistant')
                ->group(base_path('routes/api/assistant.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
