<?php

namespace App\Listeners\Api;

use App\Events\Api\LoginNotificationEvent;
use App\Mail\Api\Auth\LoginAlertEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class LoginNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LoginNotificationEvent $event): void
    {
        try {
            Mail::to($event->user->email)->send(new LoginAlertEmail($event->user->name, $event->user->type));
        } catch (\Exception $e) {
            //
        }

    }
}
