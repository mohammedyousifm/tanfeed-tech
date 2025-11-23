<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Complaint;
use App\Mail\SendContractToUser;
use Illuminate\Support\Facades\Mail;
use App\Mail\MerchantStatusChangedMail;
use Illuminate\Support\Facades\Log;
use Exception;

class MerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // بدء الاستعلام الأساسي للتجار فقط
        $query = User::where('role', 'merchant');

        // فلترة البحث (بالاسم، رقم العميل أو البريد الإلكتروني)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('client_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // ترتيب النتائج وأخذ 10 عناصر في كل صفحة
        $merchants = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.lawyer.merchant.index', compact('merchants', 'user'));
    }


    public function updateStatus(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // -------------------------
            // 1) Validate
            // -------------------------
            $validated = $request->validate([
                'status' => 'required|in:pending,suspended,active',
            ]);

            // -------------------------
            // 2) Get User
            // -------------------------
            $user = User::findOrFail($id);
            $oldStatus = $user->status;
            $newStatus = $validated['status'];

            if ($oldStatus === $newStatus) {
                return back()->with('info', 'الحالة لم تتغير، فهي بالفعل: ' . $user->status_label);
            }

            // -------------------------
            // 3) Update Status
            // -------------------------
            $user->update(['status' => $newStatus]);

            // -------------------------
            // 4) Prepare Email content
            //    (Using the status_label accessor)
            // -------------------------
            $messages = [
                'active'    => 'لقد تم تفعيل حسابك بنجاح.',
                'suspended' => 'تم تعليق حسابك. الرجاء التواصل مع الإدارة.',
                'pending'   => 'تم وضع حسابك في حالة المراجعة.',
            ];

            $emailText = $messages[$newStatus] ?? 'تم تحديث حالة حسابك.';

            // labels from accessor
            $oldLabel = (clone $user)->fill(['status' => $oldStatus])->status_label;
            $newLabel = $user->status_label;

            // -------------------------
            // 5) Send Email (rollback if fails)
            // -------------------------
            if (!empty($user->email)) {
                Mail::to($user->email)->send(
                    new MerchantStatusChangedMail($user, $oldLabel, $newLabel, $emailText)
                );
            }

            DB::commit();

            return back()->with('success', 'تم تحديث حالة الحساب وإرسال إشعار للمستخدم.');
        } catch (\Throwable $e) {

            DB::rollBack();

            Log::error('Error updating user status', [
                'user_id' => $id,
                'error' => $e->getMessage(),
                'file'  => $e->getFile(),
                'line'  => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'حدث خطأ: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified merchant with merchant details.
     */
    public function show($id)
    {
        $user = Auth::user();

        // ✅ Fetch merchant with related company info (if exists)
        $merchant = User::with('companyinfo')->findOrFail($id);

        // ✅ Get all complaints related to this merchant
        $complaints = Complaint::where('user_id', $merchant->id)
            ->latest()
            ->get();

        // ✅ Return the view with clean, well-named variables
        return view('dashboard.lawyer.merchant.show', compact('merchant', 'user', 'complaints'));
    }

    public function sendContract($id)
    {
        $user = User::findOrFail($id);

        // Create unique upload link (you can use route or signed URL)
        $uploadLink = route('contract.upload', ['user' => $user->id, 'token' => sha1($user->email . time())]);

        // Send email with attachments
        Mail::to($user->email)->send(new SendContractToUser($user, $uploadLink));

        return back()->with('success', 'تم إرسال العقد للتاجر بنجاح ✅');
    }


    public function destroy($id)
    {
        $merchant = User::findOrFail($id);

        // If you need to handle related data, you can do:
        // $merchant->complaints()->delete();

        $merchant->delete();

        return redirect()
            ->back()
            ->with('success', 'تم حذف التاجر بنجاح.');
    }
}
