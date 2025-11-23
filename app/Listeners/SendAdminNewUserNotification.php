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

        $adminEmail = config('mail.admin_emails');
        Mail::to($adminEmail)
            ->send(new AdminNewUserRegistered($user));
    }
}
