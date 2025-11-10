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
        $user = Auth::user();

        // ✅ Get the complaint (collectors can view their assigned complaints)
        $complaint = Complaint::findOrFail($id);

        // ✅ Get all follow-ups for this complaint (lawyer + collector)
        $followUps = FollowUp::where('complaint_id', $complaint->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.collector.follow-up.index', compact('user', 'complaint', 'followUps'));
    }


    public function store(Request $request)
    {
        try {

            // ✅ Validate input
            $request->validate([
                'complaint_id'         => 'required|exists:complaints,id',
                'call_number'          => 'nullable|string|max:50',
                'method'               => 'required|string|max:255',
                'call_date'            => 'nullable|date',
                'call_time'            => 'nullable',
                'called_person_name'   => 'nullable|string|max:100',
                'called_person_role'   => 'nullable|string|max:100',
                'payment_commitment'   => 'nullable|boolean',
                'payment_date'         => 'nullable|date',
                'note'                 => 'nullable|string',
            ]);

            // ✅ Collector ID
            $collectorId = Auth::id();

            // ✅ Create new follow-up
            $followUp = new FollowUp();
            $followUp->complaint_id        = $request->input('complaint_id');
            $followUp->collector_id        = $collectorId;
            $followUp->added_by_role       = 'collector';
            $followUp->call_number         = $request->input('call_number');
            $followUp->method              = $request->input('method');
            $followUp->call_date           = $request->input('call_date');
            $followUp->call_time           = $request->input('call_time');
            $followUp->called_person_name  = $request->input('called_person_name');
            $followUp->called_person_role  = $request->input('called_person_role');
            $followUp->payment_commitment  = $request->boolean('payment_commitment');
            $followUp->payment_date        = $request->input('payment_date');
            $followUp->note                = $request->input('note');
            $followUp->is_read             = false;
            $followUp->follow_date         = now();

            $followUp->save();

            return back()->with('success', '✅ تم حفظ المتابعة بنجاح.');
        } catch (\Exception $e) {
            Log::error('Follow-up store failed: ' . $e->getMessage());
            return back()->with('error', '❌ حدث خطأ أثناء حفظ المتابعة، يرجى المحاولة لاحقًا.');
        }
    }
}
