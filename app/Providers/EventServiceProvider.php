<?php

namespace App\Providers;

use App\Events\Api\LoginNotificationEvent;
use App\Listeners\Api\LoginNotificationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [

        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {

        Event::listen(
            LoginNotificationEvent::class,
            [LoginNotificationListener::class,'handle']
        );

    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
