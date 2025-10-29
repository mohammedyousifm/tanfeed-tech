<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Count only complaints belonging to this user
        $stats = [
            'pending'      => Complaint::where('user_id', $user->id)->where('status', 'pending')->count(),
            'in_progress'  => Complaint::where('user_id', $user->id)->where('status', 'in_progress')->count(),
            'completed'    => Complaint::where('user_id', $user->id)->where('status', 'completed')->count(),
            'cancelled'    => Complaint::where('user_id', $user->id)->where('status', 'cancelled')->count(),
            'accepted'     => Complaint::where('user_id', $user->id)->where('status', 'accepted')->count(),
            'suspended'    => Complaint::where('user_id', $user->id)->where('status', 'suspended')->count(),
        ];

        return view('dashboard.merchant.index', compact('user', 'stats'));
    }
}
