<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1️⃣ عدد العملاء (only users with role = merchant)
        $merchantCount = \App\Models\User::where('role', 'merchant')->count();

        // 2️⃣ عدد جميع الشكاوى
        $totalComplaints = \App\Models\Complaint::count();

        // 3️⃣ عدد الشكاوى حسب الحالة
        $stats = [
            'pending'      => Complaint::where('status', 'pending')->count(),
            'in_progress'  => Complaint::where('status', 'in_progress')->count(),
            'completed'    => Complaint::where('status', 'completed')->count(),
            'cancelled'    => Complaint::where('status', 'cancelled')->count(),
            'accepted'     => Complaint::where('status', 'accepted')->count(),
            'suspended'    => Complaint::where('status', 'suspended')->count(),
        ];

        return view('dashboard.lawyer.index', compact('user', 'stats', 'merchantCount', 'totalComplaints'));
    }
}
