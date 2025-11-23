<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;
use App\Models\SuspendedComplaint;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UnavailablePhonesExport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Complaint::query();

        // 🔍 Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('contract_number', 'like', "%{$search}%")
                    ->orWhere('client_city', 'like', "%{$search}%");
            });
        }

        // 🟢 Status filter
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        } else {
            // ✅ Default filter if no search or status selected
            if (!$request->has('search')) {
                $query->where('status', '!=', 'completed');
            }
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.lawyer.complaints.index', compact('complaints', 'user'));
    }

    /**
     * Update the collector assigned to the complaint.
     *
     * Validates that the provided collector ID exists in the users table,
     * then updates the complaint's collector_id field accordingly.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  Complaint ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateCollectors(Request $request, $id)
    {

        $complaint = Complaint::findOrFail($id);

        $request->validate([
            'collector_id' => 'exists:users,id',
        ]);

        $complaint->update([
            'collector_id' => $request->collector_id,
        ]);

        return redirect()->back()->with('success', 'تم تحديث المحصلين بنجاح');
    }

    /**
     * Update the requested service for the complaint.
     *
     * Validates the selected service, retrieves the complaint by ID,
     * updates the service_requested value, and saves the changes.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id  Complaint ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateService(Request $request, $id)
    {
        $request->validate([
            'service_requested' => 'required|string'
        ]);

        $complaint = Complaint::findOrFail($id);
        $complaint->service_requested = $request->service_requested;
        $complaint->save();

        return back()->with('success', 'تم تحديث الخدمة المطلوبة بنجاح');
    }


    /**
     * Display the specified complaint with merchant details.
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

        return view('dashboard.lawyer.complaints.show', compact('complaint', 'merchant', 'user'));
    }

    /**
     * Display a listing of the resource.
     */
    public function obtainedcontracts(Request $request)
    {
        $user = Auth::user();
        $filter = $request->input('filter');
        $month = $request->input('month');

        $query = Complaint::query()->withSum('collections', 'amount');

        // 🔍 Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('contract_number', 'like', "%{$search}%");
            });
        }

        // 🧾 Always require some collected money
        $query->whereHas('collections', function ($q) use ($month) {
            $q->where('amount', '>', 0);

            // 🎯 If month filter applied
            if ($month) {
                $year = date('Y', strtotime($month . '-01'));
                $monthNumber = date('m', strtotime($month . '-01'));
                $q->whereYear('created_at', $year)->whereMonth('created_at', $monthNumber);
            }
        });

        // 🎛 Filter conditions
        if ($filter === 'partial') {
            $query->where('amount_remaining', '>', 0);
        } elseif ($filter === 'full') {
            $query->where('status', 'completed');
        }

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.lawyer.complaints.obtainedcontracts', compact('complaints', 'user', 'filter', 'month'));
    }


    /**
     * Display a listing of the resource.
     */
    public function neglectedcontracts(Request $request)
    {
        $user = Auth::user();
        $sevenDaysAgo = now()->subDays(7);

        $query = Complaint::query()
            // 🧮 Add last_activity_date as a subquery
            ->select('complaints.*')
            ->addSelect([
                'last_activity_date' => DB::raw('(
                SELECT GREATEST(
                    IFNULL(MAX(follow_ups.created_at), 0),
                    IFNULL(MAX(collections.created_at), 0),
                    UNIX_TIMESTAMP(complaints.created_at)
                )
                FROM complaints AS c
                LEFT JOIN follow_ups ON follow_ups.complaint_id = complaints.id
                LEFT JOIN collections ON collections.complaint_id = complaints.id
                WHERE c.id = complaints.id
            )')
            ]);

        // 🔍 Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('contract_number', 'like', "%{$search}%");
            });
        }

        // 🕒 Filter by inactivity > 7 days
        $query->where(function ($q) use ($sevenDaysAgo) {
            $q->whereDoesntHave('followUps', function ($sub) use ($sevenDaysAgo) {
                $sub->where('created_at', '>=', $sevenDaysAgo);
            })
                ->whereDoesntHave('collections', function ($sub) use ($sevenDaysAgo) {
                    $sub->where('created_at', '>=', $sevenDaysAgo);
                });
        });

        // 📅 Also ensure complaint itself is at least 7 days old
        $query->where('created_at', '<=', $sevenDaysAgo);

        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        // 🧮 Convert timestamp to Carbon instance for display
        foreach ($complaints as $complaint) {
            if ($complaint->last_activity_date) {
                $complaint->last_activity_date = Carbon::createFromTimestamp($complaint->last_activity_date);
            } else {
                $complaint->last_activity_date = $complaint->created_at;
            }
        }

        return view('dashboard.lawyer.complaints.neglectedcontracts', compact('complaints', 'user'));
    }

    public function cancelled(Request $request)
    {
        $user = Auth::user();

        $query = Complaint::query()->where('status', 'cancelled');

        // 🔍 Search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('client_name', 'like', "%{$search}%")
                    ->orWhere('serial_number', 'like', "%{$search}%")
                    ->orWhere('contract_number', 'like', "%{$search}%");
            });
        }



        $complaints = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.lawyer.complaints.cancelled', compact('complaints', 'user'));
    }

    public function exportUnavailable()
    {
        // Count complaints with unavailable phone numbers
        $count = Complaint::where('phone_status', 'not_available')->count();

        if ($count === 0) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'لا توجد طلبات تحتوي على أرقام غير متاحة للتصدير.');
        }

        // If found, proceed with export
        return Excel::download(new UnavailablePhonesExport, 'unavailable_phones.xlsx');
    }


    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);

        // If there are related models (like collections), you can handle them here:
        // $complaint->collections()->delete();

        $complaint->delete();

        return redirect()->route('lawyer.complaints.index')
            ->with('success', 'تم حذف الطلب بنجاح');
    }
}
