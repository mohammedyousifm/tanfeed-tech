<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */

    public function store(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route($user->role . '.dashboard', absolute: false));
        }

        $request->user()->notify(new \App\Notifications\CustomVerifyEmail());


        return back()->with('status', 'verification-link-sent');
    }
}
