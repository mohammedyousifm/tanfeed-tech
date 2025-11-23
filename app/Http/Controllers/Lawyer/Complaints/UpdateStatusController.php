<?php

namespace App\Http\Controllers\Lawyer\Complaints;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Complaint;
use App\Models\User;
use App\Mail\ComplaintStatusChanged;
use App\Models\SuspendedComplaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class UpdateStatusController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'status' => 'required|in:pending,in_progress,completed,cancelled,suspended,accepted',
                'suspended_reason' => 'nullable|string|max:1000',
            ]);

            $complaint = Complaint::findOrFail($id);
            $oldStatus = $complaint->status;
            $newStatus = $validated['status'];

            Log::info("Updating complaint status", [
                'complaint_id' => $complaint->id,
                'old' => $oldStatus,
                'new' => $newStatus,
            ]);

            // تحديث الحالة
            $complaint->update(['status' => $newStatus]);

            // تعليق الشكوى
            $suspendedReason = null;

            if ($newStatus === 'suspended') {

                $suspendedReason = $validated['suspended_reason'];

                SuspendedComplaint::updateOrCreate(
                    ['complaint_id' => $complaint->id],
                    ['reason' => $suspendedReason]
                );
            }

            // ⭕ إرسال الإيميل — إذا فشل الإرسال → rollback
            Mail::to($complaint->user->email)->send(
                new ComplaintStatusChanged($complaint, $oldStatus, $newStatus, $suspendedReason)
            );

            DB::commit();

            return redirect()->back()->with('success', 'تم تحديث حالة الطلب وتم إرسال الإشعار بنجاح.');
        } catch (\Throwable $e) {
            DB::rollBack();

            Log::error("Error updating complaint status", [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', "حدث خطأ أثناء تحديث حالة الطلب: " . $e->getMessage());
        }
    }
}
