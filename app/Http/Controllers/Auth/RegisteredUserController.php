<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\CompanyProfile;
use Illuminate\Auth\Events\Registered;
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
        // ✅ التحقق من صحة البيانات
        $request->validate([
            'account_manager_name' => ['required', 'string', 'max:255'],
            'accountEmail' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', Rules\Password::defaults()],
            'terms' => ['accepted'],

            // ✅ تحقق من ملفات PDF
            'owner_id_pdf' => ['required', 'file', 'mimes:pdf', 'max:2048'],
            'commercial_record_pdf' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ]);

        // ✅ إنشاء المستخدم
        $user = User::create([
            'name' => $request->account_manager_name,
            'email' => $request->accountEmail,
            'password' => Hash::make($request->password),
            'terms_accepted' => $request->has('terms'),
        ]);

        // ✅ رفع الملفات وتخزين المسارات
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
            'phone_1' => $request->phone_1,
            'phone_2' => $request->phone_2,
            'company_email' => $request->company_email,
            'owner_id_pdf' => $ownerPath,
            'commercial_record_pdf' => $recordPath,
        ]);

        // ✅ تسجيل الدخول للمستخدم الجديد
        Auth::login($user);

        // ✅ توجيه المستخدم لصفحة التحقق من البريد
        return redirect()->route('verification.notice');
    }
}
