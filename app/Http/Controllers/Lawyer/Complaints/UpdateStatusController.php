<?php

namespace App\Http\Controllers\Lawyer\Complaints;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;
use App\Mail\ComplaintAcceptedNotification;
use App\Mail\ComplaintSuspendedMail;
use App\Mail\ComplaintAcceptedMail;
use App\Models\SuspendedComplaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class UpdateStatusController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,in_progress,completed,cancelled,suspended,accepted',
                'suspended_reason' => 'nullable|string|max:1000',
            ]);

            $complaint = Complaint::findOrFail($id);
            $oldStatus = $complaint->status;
            $newStatus = $validated['status'];

            Log::info('Updating complaint status', [
                'complaint_id' => $complaint->id,
                'old' => $oldStatus,
                'new' => $newStatus,
            ]);

            $complaint->updateQuietly(['status' => $newStatus]);

            if ($newStatus === 'suspended') {
                Log::info('Suspending complaint: ' . $complaint->id);

                SuspendedComplaint::updateOrCreate(
                    ['complaint_id' => $complaint->id],
                    ['reason' => $validated['suspended_reason']]
                );

                if ($complaint->user && $complaint->user->email) {
                    Mail::to($complaint->user->email)
                        ->send(new ComplaintSuspendedMail($complaint, $validated['suspended_reason']));
                    Log::info('Suspension mail sent to ' . $complaint->user->email);
                }
            }

            if ($oldStatus === 'suspended' && $newStatus !== 'suspended') {
                SuspendedComplaint::where('complaint_id', $complaint->id)->delete();
                Log::info('Suspension record deleted for ' . $complaint->id);
            }

            if ($newStatus === 'accepted') {
                Log::info('Complaint accepted: sending mail');
                if ($complaint->user && $complaint->user->email) {
                    Mail::to($complaint->user->email)
                        ->send(new ComplaintAcceptedMail($complaint));
                    Log::info('Acceptance mail sent to ' . $complaint->user->email);
                }
            }

            return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
        } catch (Exception $e) {
            Log::error('Error updating complaint status', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with('error', 'حدث خطأ أثناء تحديث حالة الطلب. الرجاء المحاولة لاحقًا.');
        }
    }
}
