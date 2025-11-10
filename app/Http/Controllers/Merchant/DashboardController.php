<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Mail\NewUserContractMail;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ✅ نحاول إرسال البريد
        // $uploadLink = route('contract.upload', ['user' => $user->id]);

        // Mail::to($user->email)->send(new NewUserContractMail(
        //     $user,
        //     $uploadLink
        // ));

        // Count only complaints belonging to this user
        $stats = [
            'pending'      => Complaint::where('user_id', $user->id)->where('status', 'pending')->count(),
            'in_progress'  => Complaint::where('user_id', $user->id)->where('status', 'in_progress')->count(),
            'completed'    => Complaint::where('user_id', $user->id)->where('status', 'completed')->count(),
            'cancelled'    => Complaint::where('user_id', $user->id)->where('status', 'cancelled')->count(),
            'accepted'     => Complaint::where('user_id', $user->id)->where('status', 'accepted')->count(),
            'suspended'    => Complaint::where('user_id', $user->id)->where('status', 'suspended')->count(),
        ];

        $totalAmountRemaining = Complaint::where('user_id', $user->id)->sum('amount_remaining');
        $totalAmountCollated  = Complaint::where('user_id', $user->id)->sum('amount_collated');

        return view(
            'dashboard.merchant.index',
            compact(
                'user',
                'stats',
                'totalAmountRemaining',
                'totalAmountCollated'
            )
        );
    }

    public function notactive()
    {
        $user = Auth::user();
        return view('errors.not-active', compact('user'));
    }
}
