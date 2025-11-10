<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Complaint;
use App\Mail\SendContractToUser;
use Illuminate\Support\Facades\Mail;
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
        try {
            $request->validate([
                'status' => 'required|in:pending,suspended,active',
            ]);

            $users = User::findOrFail($id);
            $users->updateQuietly(['status' => $request->status]);

            // Send email only if complaint accepted
            if ($request->status === 'accepted') {
                $userMail = $users->user->email;
                // Mail::to('mahmadyasaf020@gmail.com')->send(new ComplaintAcceptedNotification($complaint));
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
