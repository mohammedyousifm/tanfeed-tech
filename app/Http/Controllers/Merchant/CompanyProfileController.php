<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    public function index()
    {
        return view('auth.compleate');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_email' => 'required|email',
            'establishment_number' => 'required',
            'business_type' => 'required',
            'city' => 'required',
            'district' => 'required',
            'manager_name' => 'required',
            'phone_1' => 'required',
            'phone_2' => 'required',
            'owner_id_pdf' => 'required|file|mimes:pdf|max:2048',
            'commercial_record_pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('owner_id_pdf')) {
            $validated['owner_id_pdf'] = $request->file('owner_id_pdf')->store('company_docs', 'public');
        }

        if ($request->hasFile('commercial_record_pdf')) {
            $validated['commercial_record_pdf'] = $request->file('commercial_record_pdf')->store('company_docs', 'public');
        }

        CompanyProfile::create($validated);

        return redirect()->route('merchan.index')->with('success', 'تم حفظ بيانات الشركة بنجاح');
    }
}
