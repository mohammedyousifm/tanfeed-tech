<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
use App\Mail\NewComplaintNotification;
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

        $user =   Auth::user();
        $complaints =  Complaint::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('dashboard.merchant.complaints.index', compact('complaints', 'user'));
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
            $data = $request->validate([
                'client_name' => 'required|string|max:255',
                'client_national_id' => 'nullable|string|max:50',
                'commercial_name' => 'nullable|string|max:255',
                'commercial_record_number' => 'nullable|string|max:50',
                'contract_number' => 'nullable|string|max:50',
                'amount_requested' => 'nullable|numeric|min:0',
                'amount_paid' => 'nullable|numeric|min:0',
                'amount_remaining' => 'nullable|numeric|min:0',
                'service_requested' => 'nullable|string|max:255',
                'contract_attachments' => 'nullable|array',
                'contract_attachments.*' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240',
                'collector_ids' => 'nullable|array',
                'status' => 'nullable|string',
            ]);

            $filePaths = [];

            if ($request->hasFile('contract_attachments')) {
                foreach ($request->file('contract_attachments') as $file) {
                    $filePaths[] = $file->store('contracts', 'public');
                }
            }

            $data['contract_attachments'] = json_encode($filePaths);


            $data['user_id'] = auth()->id();

            $complaint = Complaint::create($data);

            if (isset($data['collector_ids'])) {
                $complaint->collectors()->sync($data['collector_ids']);
            }

            // Send email
            Mail::to('mahmadyasaf020@gmail.com')
                ->send(new NewComplaintNotification($complaint));

            return redirect()
                ->route('merchant.complaints.index')
                ->with('success', 'تم إنشاء الشكوى بنجاح');
        } catch (Exception $e) {
            // Log the error for debugging
            Log::error('Complaint creation failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            // Redirect back with error message
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'حدث خطأ أثناء إنشاء الشكوى. الرجاء المحاولة لاحقًا.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
}
