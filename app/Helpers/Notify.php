<?php

namespace App\Helpers;

use App\Models\Notification;
use App\Models\User;

class Notify
{
    /**
     * Send notification to a specific user
     */
    public static function send($userId, $title, $message, $type = null)
    {
        Notification::create([
            'user_id' => $userId,
            'title'   => $title,
            'message' => $message,
            'type'    => $type,
        ]);
    }

    /**
     * Send notification to all users with specific role
     */
    public static function sendToRole($role, $title, $message, $type = null)
    {
        $users = User::where('role', $role)->get();
        foreach ($users as $user) {
            self::send($user->id, $title, $message, $type);
        }
    }
}
