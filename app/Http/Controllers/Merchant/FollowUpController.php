<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\FollowUp;
use Illuminate\Support\Facades\Log;
use Exception;

class FollowUpController extends Controller
{
    public function index($id)
    {
        $user =   Auth::user();
        $complaint =  Complaint::findOrFail($id);
        return view('dashboard.merchant.follow-up.index', compact('user', 'complaint'));
    }
}
