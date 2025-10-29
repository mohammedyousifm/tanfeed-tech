<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;
use App\Mail\ComplaintAcceptedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Complaint::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('contract_number', 'like', "%{$search}%");
            });
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.lawyer.complaints.index', compact('complaints', 'user'));
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,in_progress,completed,cancelled,suspended,accepted',
            ]);

            $complaint = Complaint::findOrFail($id);
            $complaint->updateQuietly(['status' => $request->status]);

            // Send email only if complaint accepted
            if ($request->status === 'accepted') {
                $userMail = $complaint->user->email;
                Mail::to('mahmadyasaf020@gmail.com')->send(new ComplaintAcceptedNotification($complaint));
            }

            return redirect()->back()->with('success', 'تم تحديث حالة الشكوى بنجاح.');
        } catch (Exception $e) {
            Log::error('Error updating complaint status: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث حالة الشكوى. الرجاء المحاولة لاحقًا.');
        }
    }

    public function updateCollectors(Request $request, $id)
    {

        $complaint = Complaint::findOrFail($id);

        $request->validate([
            'collector_ids' => 'array',
            'collector_ids.*' => 'exists:users,id',
        ]);

        $complaint->update([
            'collector_ids' => $request->collector_ids,
        ]);

        return redirect()->back()->with('success', 'تم تحديث المحصلين بنجاح');
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
