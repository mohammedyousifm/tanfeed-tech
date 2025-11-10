<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Listeners\SendAdminNewUserNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendAdminNewUserNotification::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}
