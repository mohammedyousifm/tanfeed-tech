<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Notify;
use App\Models\Complaint;
use App\Models\FollowUp;
use App\Models\Collection;
use App\Models\ComplaintAttachment;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewComplaintNotification;
use App\Imports\ComplaintsImport;
use Maatwebsite\Excel\Facades\Excel;
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
        $user = Auth::user();

        // 🟢 شكاوى هذا التاجر فقط
        $complaints = Complaint::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        // 🟢 IDs للشكاوى الحالية
        $complaintIds = $complaints->pluck('id');

        // 🧾 عدد التحصيلات والتابعات
        $totalCollections = Collection::whereIn('complaint_id', $complaintIds)->count();
        $totalFollowUps   = FollowUp::whereIn('complaint_id', $complaintIds)->count();

        // 🔴 عدد التحصيلات غير المقروءة (is_read = false)
        $unseenCollections = Collection::whereIn('complaint_id', $complaintIds)
            ->where('is_read', false)
            ->count();

        // 🔴 عدد المتابعات غير المقروءة (is_read = false)
        $unseenFollowUps = FollowUp::whereIn('complaint_id', $complaintIds)
            ->where('is_read', false)
            ->count();

        return view(
            'dashboard.merchant.complaints.index',
            compact('complaints', 'user', 'unseenCollections', 'unseenFollowUps')
        );
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user =   Auth::user();
        return view('dashboard.merchant.complaints.create',  compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // ✅ التحقق من صحة البيانات الأساسية
            $validatedData = $request->validate([
                'client_name' => 'required|string|max:255',
                'client_national_id' => 'required',
                'phone_number1' => 'required',
                'phone_number2' => 'nullable',
                'client_city' => 'required|string|max:255',
                'activity_type' => 'required|string',
                'manager_name' => 'nullable|string|max:255',
                'manager_id' => 'nullable|max:20',
                'commercial_name' => 'nullable|max:255',
                'commercial_record_number' => 'nullable|max:50',
                'contract_number' => 'required|max:50',
                'service_requested' => 'required|max:255',
                'amount_requested' => 'required|numeric|min:0',
                'amount_paid' => 'nullable|numeric|min:0',
                'complaint_notes' => 'nullable|max:255',

                // ✅ تحقق من المرفقات الجديدة
                'attachment_names.*' => 'nullable|string|max:255',
                'attachment_files.*' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:20240',
            ]);

            // ✅ القيم المحسوبة
            $amountRequested = $validatedData['amount_requested'];
            $amountPaid = $validatedData['amount_paid'] ?? 0;
            $amountRemaining = $amountRequested - $amountPaid;

            // ✅ حفظ الشكوى (بدون مرفقات)
            $complaint = Complaint::create([
                'user_id' => Auth::id(),
                'collector_ids' => null,
                'client_name' => $validatedData['client_name'],
                'client_city' => $validatedData['client_city'],
                'client_national_id' => $validatedData['client_national_id'],
                'phone_number1' => $validatedData['phone_number1'],
                'phone_number2' => $validatedData['phone_number2'] ?? null,
                'activity_type' => $validatedData['activity_type'],
                'manager_name' => $validatedData['manager_name'] ?? null,
                'manager_id' => $validatedData['manager_id'] ?? null,
                'commercial_name' => $validatedData['commercial_name'] ?? null,
                'commercial_record_number' => $validatedData['commercial_record_number'] ?? null,
                'contract_number' => $validatedData['contract_number'],
                'service_requested' => $validatedData['service_requested'],
                'amount_requested' => $amountRequested,
                'amount_paid' => $amountPaid,
                'amount_remaining' => $amountRemaining,
                'complaint_notes' => $validatedData['complaint_notes'] ?? null,
            ]);

            // ✅ معالجة المرفقات إن وُجدت
            if ($request->hasFile('attachment_files')) {
                foreach ($request->file('attachment_files') as $index => $file) {
                    if ($file) {
                        // رفع الملف
                        $path = $file->store('complaints', 'public');

                        // الحصول على اسم المرفق المقابل (إن وُجد)
                        $name = $request->attachment_names[$index] ?? pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

                        // حفظ في جدول complaint_attachments
                        $complaint->attachments()->create([
                            'file_name' => $path,
                            'display_name' => $name,
                        ]);
                    }
                }
            }

            Notify::sendToRole(
                'lawyer',
                'طلب جديدة',
                'تم تقديم طلب جديد من التاجر ' . Auth::user()->name .
                    ' برقم طلب  ' . $complaint->serial_number,
                'complaint'
            );

            // ✅ نجاح العملية
            return redirect()
                ->route('merchant.complaints.index')
                ->with('success', 'تم حفظ بيانات العميل والمرفقات بنجاح.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'حدث خطأ أثناء الحفظ: ' . $e->getMessage()])
                ->withInput();
        }
    }

    public function attachments_store(Request $request, Complaint $complaint)
    {
        $request->validate([
            'attachment_names.*' => 'nullable|string|max:255',
            'attachment_files.*' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120', // 5MB max
        ]);

        if ($request->hasFile('attachment_files')) {
            foreach ($request->file('attachment_files') as $index => $file) {
                $path = $file->store('complaint_attachments', 'public');

                ComplaintAttachment::create([
                    'complaint_id' => $complaint->id,
                    'display_name' => $request->attachment_names[$index] ?? null,
                    'file_name' => $path,
                ]);
            }
        }

        return back()->with('success', 'تم حفظ المرفقات بنجاح ✅');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = Auth::user();

        // Load complaint with related merchant (user)
        $complaint = Complaint::with('user')->findOrFail($id);

        // If you named relation differently, e.g. merchant(), adjust this:
        $merchant = $complaint->user;

        // Optional: handle case when merchant is missing
        if (!$merchant) {
            return redirect()->back()->with('error', 'لم يتم العثور على بيانات التاجر المرتبطة بهذه الشكوى.');
        }

        return view('dashboard.merchant.complaints.show', compact('complaint', 'merchant', 'user'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => ['required', 'mimes:xlsx,xls']
        ]);

        Excel::import(new ComplaintsImport, $request->file('file'));

        return redirect()->back()->with('success', 'تم رفع الملف بنجاح وإضافة الشكاوى.');
    }

    public function pending()
    {
        $user = Auth::user();

        // 🟢 شكاوى هذا التاجر فقط
        $complaints = Complaint::where('user_id', $user->id)
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view(
            'dashboard.merchant.complaints.pending',
            compact('complaints', 'user')
        );
    }
}
