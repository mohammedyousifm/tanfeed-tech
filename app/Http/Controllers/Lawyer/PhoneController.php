<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Log;
use Exception;

class PhoneController extends Controller
{
    public function updateStatus(Request $request, $id)
    {

        try {
            $request->validate([
                'status' => 'required|in:available,not_available',
            ]);

            $complaint = Complaint::findOrFail($id);
            $complaint->updateQuietly(['phone_status' => $request->status]);

            return redirect()->back()->with('success', 'تم تحديث حالة رقم الهاتف.');
        } catch (Exception $e) {
            Log::error('Error updating complaint status: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء تحديث رقم الهاتف. الرجاء المحاولة لاحقًا.');
        }
    }

    public function updatePhones(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        // ✅ Validate inputs
        $request->validate([
            'phone_number1' => ['nullable', 'string', 'max:20'],
            'phone_number2' => ['nullable', 'string', 'max:20'],
        ]);

        // ✅ Update phone numbers
        $complaint->update([
            'phone_number1' => $request->phone_number1,
            'phone_number2' => $request->phone_number2,
        ]);

        return redirect()
            ->back()
            ->with('success', 'تم تحديث أرقام الجوال بنجاح.');
    }
}
