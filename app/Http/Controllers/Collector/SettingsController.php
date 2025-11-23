<?php

namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.collector.settings.index', compact('user'));
    }

    /**
     * Update lawyer profile info.
     */
    public function updateProfile(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
        ]);

        $user = Auth::user();

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return back()->with('success', 'تم تحديث معلوماتك بنجاح ✅');
    }
}
