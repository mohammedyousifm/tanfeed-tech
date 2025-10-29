<?php

namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user =   Auth::user();
        $complaints = Complaint::whereJsonContains('collector_ids', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('dashboard.collector.complaints.index', compact('complaints', 'user'));
    }

    /**
     * Display the specified complaint with merchant details.
     */
    public function show($id)
    {
        $user = Auth::user();

        // Load complaint with related merchant (user)
        $complaint = Complaint::with('user')->findOrFail($id);

        // If you named relation differently, e.g. merchant(), adjust this:
        $merchant = $complaint->user;

        // Optional: handle case when merchant is missing
        if (!$merchant) {
            return redirect()->back()->with('error', 'لم يتم العثور على بيانات التاجر المرتبطة بهذه الشكوى.');
        }

        return view('dashboard.lawyer.complaints.show', compact('complaint', 'merchant', 'user'));
    }
}
