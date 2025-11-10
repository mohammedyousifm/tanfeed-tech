<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.lawyer.settings.index', compact('user'));
    }
}
