<?php

namespace App\Http\Controllers\Collector;

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
        $complaint = Complaint::where('id', $id)
            ->whereJsonContains('collector_ids', $user->id)
            ->firstOrFail();
        return view('dashboard.collector.follow-up.index', compact('user', 'complaint'));
    }

    public function store(Request $request)
    {


        try {
            // ✅ Validate input
            $request->validate([
                'complaint_id' => 'required|exists:complaints,id',
                'method'       => 'required|string|max:255',
                'follow_date'  => 'required|date',
                'note'         => 'nullable|string',
            ]);


            // ✅ Prepare collector as JSON
            $collectorId = Auth::id();

            // ✅ Create the follow-up record
            $followUp = new FollowUp();
            $followUp->complaint_id = $request->input('complaint_id');
            $followUp->collector_id = $collectorId;
            $followUp->method       = $request->input('method');
            $followUp->follow_date  = $request->input('follow_date');
            $followUp->note         = $request->input('note');
            $followUp->save();

            return back()->with('success', 'تم حفظ المتابعة بنجاح.');
        } catch (Exception $e) {
            Log::error('Follow-up store failed: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء حفظ المتابعة، يرجى المحاولة لاحقًا.');
        }
    }
}
