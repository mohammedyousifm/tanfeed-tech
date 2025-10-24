<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
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
    public function index()
    {

        $complaints =  Complaint::orderBy('created_at', 'desc')
            ->paginate(10);
        $user =   Auth::user();

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
}
