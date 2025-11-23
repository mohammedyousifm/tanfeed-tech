<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\CompanyProfile;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // ✅ تحقق من صحة البيانات أولاً
        $request->validate([
            'account_manager_name' => ['required', 'string', 'max:255'],
            'accountEmail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'terms' => ['accepted'],

            // ✅ تحقق من ملفات PDF
            'owner_id_pdf' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'national_id' => ['required'],
            'commercial_record_pdf' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ]);


        try {
            // ✅ نستخدم Transaction لضمان سلامة البيانات
            DB::beginTransaction();

            // ✅ إنشاء المستخدم
            $user = User::create([
                'name' => $request->account_manager_name,
                'email' => $request->accountEmail,
                'password' => Hash::make($request->password),
                'terms_accepted' => $request->has('terms'),
            ]);

            // ✅ رفع الملفات
            $ownerPath = $request->file('owner_id_pdf')->store('uploads/owners', 'public');
            $recordPath = $request->file('commercial_record_pdf')->store('uploads/records', 'public');

            // ✅ إنشاء سجل الشركة
            CompanyProfile::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name,
                'establishment_number' => $request->commercial_number,
                'business_type' => $request->activity_type,
                'city' => $request->city,
                'district' => $request->district,
                'manager_name' => $request->manager_name,
                'national_id' => $request->national_id,
                'phone_1' => $request->phone_1,
                'phone_2' => $request->phone_2,
                'company_email' => $request->company_email,
                'owner_id_pdf' => $ownerPath,
                'commercial_record_pdf' => $recordPath,
            ]);

            event(new Registered($user));


            // ✅ إذا تم كل شيء بنجاح
            DB::commit();

            // ✅ تسجيل الدخول للمستخدم
            Auth::login($user);

            return redirect()->route('verification.notice')
                ->with('success', 'تم إنشاء حسابك بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Registration failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // 🧩 Show detailed error only in local environment
            if (app()->environment('local')) {
                return back()->withInput()->with('error', 'Error: ' . $e->getMessage());
            }

            // ⚠️ In production, show a friendly message
            return back()->withInput()->with('error', 'حدث خطأ أثناء التسجيل. يرجى المحاولة مرة أخرى.');
        }
    }
}
