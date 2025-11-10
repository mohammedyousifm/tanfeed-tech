<?php

namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;

class DashboardController extends Controller
{
    public function index()
    {
        $user =   Auth::user();

        $totalCollectorComplaints = Complaint::where('collector_id', $user->id)
            ->count();

        // 3️⃣ عدد الشكاوى حسب الحالة
        $stats = [
            'in_progress'  => Complaint::where('collector_id', $user->id)->where('status', 'in_progress')->count(),
            'completed'    => Complaint::where('collector_id', $user->id)->where('status', 'completed')->count(),
        ];

        return view('dashboard.collector.index', compact('user', 'totalCollectorComplaints', 'stats'));
    }
}
