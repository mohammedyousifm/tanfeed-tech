<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Complaint;
use App\Mail\ComplaintAcceptedNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class CollectorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user =   Auth::user();

        // بدء الاستعلام الأساسي للتجار فقط
        $query = User::where('role', 'collector');

        // فلترة البحث (بالاسم، رقم العميل أو البريد الإلكتروني)
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('client_number', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // ترتيب النتائج وأخذ 10 عناصر في كل صفحة
        $collectors = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.lawyer.collectors.index', compact('collectors', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'status'   => 'active',
            'password' => Hash::make($request->password),
            'role'     => 'collector',
        ]);

        return redirect()->back()->with('success', 'تمت إضافة المحصل بنجاح');
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

    public function destroy($id)
    {
        $collector = User::findOrFail($id);

        $collector->delete();

        return redirect()
            ->back()
            ->with('success', 'تم حذف المحصل بنجاح.');
    }
}
