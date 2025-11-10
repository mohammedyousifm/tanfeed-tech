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
        $user = Auth::user();

        // ✅ Get the complaint for this user (merchant)
        $complaint = Complaint::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // ✅ Mark all as read
        FollowUp::where('complaint_id', $complaint->id)
            ->update(['is_read' => true]);

        // ✅ Filter follow-ups:
        $followUps = FollowUp::where('complaint_id', $complaint->id)
            ->where('lawyer_approved', true)
            ->orderBy('created_at', 'desc')
            ->get();


        return view('dashboard.merchant.follow-up.index', compact('user', 'complaint', 'followUps'));
    }
}
