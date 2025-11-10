<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        View::composer('*', function ($view) {

            $unreadCount = 0; // ✅ define default value

            if (Auth::check()) {
                $unreadCount = Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->count();
            }

            $view->with('unreadCount', $unreadCount);
        });
    }
}
