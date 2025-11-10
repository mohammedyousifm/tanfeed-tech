<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1️⃣ عدد العملاء (التجار)
        $merchantCount = User::where('role', 'merchant')->count();

        // 2️⃣ عدد جميع الشكاوى
        $totalComplaints = Complaint::count();

        // 3️⃣ عدد الشكاوى حسب الحالة
        $stats = [
            'pending'      => Complaint::where('status', 'pending')->count(),
            'in_progress'  => Complaint::where('status', 'in_progress')->count(),
            'completed'    => Complaint::where('status', 'completed')->count(),
            'cancelled'    => Complaint::where('status', 'cancelled')->count(),
            'accepted'     => Complaint::where('status', 'accepted')->count(),
            'suspended'    => Complaint::where('status', 'suspended')->count(),
        ];

        // 4️⃣ إجمالي المبالغ
        $totalAmountRemaining = Complaint::sum('amount_remaining');
        $totalAmountCollated  = Complaint::sum('amount_collated');

        return view('dashboard.lawyer.index', compact(
            'user',
            'stats',
            'merchantCount',
            'totalComplaints',
            'totalAmountRemaining',
            'totalAmountCollated'
        ));
    }
}
