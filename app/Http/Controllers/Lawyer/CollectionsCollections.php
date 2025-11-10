<?php

namespace App\Http\Controllers\Lawyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use App\Models\Collection;
use Illuminate\Support\Facades\Log;
use Exception;

class CollectionsCollections extends Controller
{
    public function index($id)
    {
        $user =   Auth::user();
        $complaint =  Complaint::findOrFail($id);
        return view('dashboard.lawyer.collections.index', compact('user', 'complaint'));
    }


    public function store(Request $request)
    {
        try {
            // ✅ Validate input
            $request->validate([
                'complaint_id'        => 'required|exists:complaints,id',
                'collection_date'     => 'required|date',
                'amount'              => 'required|numeric|min:0',
                'collection_receipt'  => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
                'tanfeed_fee'         => 'nullable|numeric|min:0',
                'tanfeed_receipt'     => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            // ✅ Handle file uploads safely
            $collectionReceiptPath = $request->hasFile('collection_receipt')
                ? $request->file('collection_receipt')->store('collections/receipts', 'public')
                : null;

            $tanfeedReceiptPath = $request->hasFile('tanfeed_receipt')
                ? $request->file('tanfeed_receipt')->store('collections/tanfeed', 'public')
                : null;

            // ✅ Get the related complaint
            $complaint = Complaint::findOrFail($request->complaint_id);

            // ✅ Create collection record
            $collection = new Collection();
            $collection->complaint_id       = $complaint->id;
            $collection->collector_id       = Auth::id();
            $collection->collection_date    = $request->collection_date;
            $collection->amount             = $request->amount;
            $collection->collection_receipt = $collectionReceiptPath;
            $collection->tanfeed_fee        = $request->tanfeed_fee;
            $collection->tanfeed_receipt    = $tanfeedReceiptPath;
            $collection->save();

            // ✅ Update complaint financial fields
            $complaint->amount_collated  += $request->amount; // add to total collected
            $complaint->amount_paid      += $request->amount; // optional: track total paid
            $complaint->amount_remaining = max(0, $complaint->amount_remaining - $request->amount); // prevent negative
            if ($complaint->amount_remaining <= 0) {
                $complaint->status = 'completed';
            }
            $complaint->save();

            return back()->with('success', 'تم حفظ التحصيل وتحديث بيانات الشكوى بنجاح.');
        } catch (Exception $e) {
            // 🧠 Log the error for debugging
            Log::error('Collection store failed: ' . $e->getMessage());

            return back()->with('error', 'حدث خطأ أثناء حفظ التحصيل، يرجى المحاولة لاحقًا.');
        }
    }


    public function uploadTanfeed(Request $request)
    {
        try {
            $request->validate([
                'collection_id' => 'required|exists:collections,id',
                'tanfeed_receipt' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            ]);

            $collection = Collection::findOrFail($request->collection_id);

            // Upload file
            $path = $request->file('tanfeed_receipt')->store('collections/tanfeed', 'public');

            // Update record
            $collection->tanfeed_receipt = $path;
            $collection->save();

            return back()->with('success', 'تم رفع إيصال تنفيذ تك بنجاح.');
        } catch (Exception $e) {
            Log::error('Tanfeed upload failed: ' . $e->getMessage());
            return back()->with('error', 'حدث خطأ أثناء رفع الإيصال، يرجى المحاولة لاحقًا.');
        }
    }
}
