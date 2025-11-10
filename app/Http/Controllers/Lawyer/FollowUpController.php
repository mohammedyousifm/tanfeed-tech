<?php

namespace App\Http\Controllers\Lawyer;

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

        // ✅ Get the complaint (lawyers can view all complaints assigned to them)
        $complaint = Complaint::findOrFail($id);

        // ✅ Get all follow-ups (from collectors)
        $followUps = FollowUp::where('complaint_id', $complaint->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.lawyer.follow-up.index', compact('user', 'complaint', 'followUps'));
    }

    /**
     * ✅ Lawyer updates (comment + approval)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'lawyer_comment'  => 'nullable|string|max:500',
            'lawyer_approved' => 'required|boolean',
        ]);

        $followUp = FollowUp::findOrFail($id);

        $followUp->lawyer_comment  = $request->lawyer_comment;
        $followUp->lawyer_approved = $request->lawyer_approved;
        $followUp->save();

        return back()->with('success', '✅ تم تحديث متابعة المحامي بنجاح.');
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

            // ✅ Lawyer ID
            $lawyerId = Auth::id();

            // ✅ Create new follow-up (auto-approved)
            $followUp = new FollowUp();
            $followUp->complaint_id        = $request->input('complaint_id');
            $followUp->collector_id        = $lawyerId; // optional if you track lawyer separately
            $followUp->added_by_role       = 'lawyer';
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

            // ✅ Auto-approve
            $followUp->lawyer_approved = true;
            $followUp->lawyer_comment  = null;

            $followUp->save();

            return back()->with('success', '✅ تم حفظ المتابعة والموافقة عليها تلقائيًا.');
        } catch (\Exception $e) {
            Log::error('Lawyer follow-up store failed: ' . $e->getMessage());
            return back()->with('error', '❌ حدث خطأ أثناء حفظ المتابعة، يرجى المحاولة لاحقًا.');
        }
    }
}
