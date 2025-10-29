<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Log;
use Exception;


class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $Companyinfo = CompanyProfile::where('user_id', $user->id)->first();

        return view('dashboard.merchant.settings.index', compact('user', 'Companyinfo'));
    }
}
