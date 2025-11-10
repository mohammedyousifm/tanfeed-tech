<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNewUserRegistered;

class SendAdminNewUserNotification
{
    public function handle(Registered $event)
    {
        $user = $event->user;

        Mail::to(['mahmadyasaf020@gmail.com', 'mkntttlyayzwl@gmail.com'])
            ->send(new AdminNewUserRegistered($user));
    }
}
