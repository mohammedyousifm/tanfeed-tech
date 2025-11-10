<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContractUploadedMail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\Notify;
use Illuminate\Http\Request;
use App\Models\Contract;

class ContractController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 🔹 Check if the user already has any contract records
        $hasContract = $user->contracts()->exists();

        if ($hasContract) {
            // 🔹 Redirect user away (e.g., to dashboard) with a warning
            return redirect()
                ->route('merchant.dashboard')
                ->with('error', 'لقد قمت بالفعل برفع عقدك. لا يمكنك رفع عقد جديد.');
        }

        // 🔹 Otherwise, show the upload page
        return view('contracts.index', compact('user'));
    }


    public function store(Request $request)
    {
        /**
         * 🔹 1. Validate Request
         * Allow uploading of both Contract and Agency Form.
         * Files must be PDF, DOC, or DOCX and up to 2MB.
         */
        $request->validate([
            'contract_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'agency_file'   => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $user = Auth::user();

            /**
             * 🔹 2. Store Uploaded Files
             * Each file is stored in `storage/app/public/contracts`
             * and recorded in the database with its file_type.
             */
            if ($request->hasFile('contract_file')) {
                $contractPath = $request->file('contract_file')->store('contracts', 'public');

                Contract::create([
                    'user_id'       => $user->id,
                    'contract_file' => $contractPath,
                    'file_type'     => 'Contract',
                ]);
            }

            if ($request->hasFile('agency_file')) {
                $agencyPath = $request->file('agency_file')->store('contracts', 'public');

                Contract::create([
                    'user_id'       => $user->id,
                    'contract_file' => $agencyPath,
                    'file_type'     => 'Agency Form',
                ]);
            }

            /**
             * 🔹 3. Notify Admin / Lawyer
             * Sends an internal notification to all users with "lawyer" role.
             */
            Notify::sendToRole(
                'lawyer',
                'عقد جديد',
                'تم إرسال عقد جديد من ' . $user->name .
                    ' (رقم التاجر: ' . $user->client_number . ')',
                'contract'
            );

            /**
             * 🔹 4. Send Email Notification to Admin
             * Sends an email with details about the uploaded contracts.
             */
            $adminEmails = ['mahmadyasaf020@gmail.com', 'mkntttlyayzwl@gmail.com'];

            Mail::to($adminEmails)->send(new ContractUploadedMail($user));

            DB::commit();

            /**
             * 🔹 5. Redirect with Success Message
             */
            return redirect()
                ->route('merchant.dashboard')
                ->with('success', 'تم رفع العقد بنجاح ✅');
        } catch (\Exception $e) {
            DB::rollBack();

            /**
             * 🔹 6. Handle Failure
             * Log the error for developers and show a friendly message to the user.
             */
            Log::error('Contract upload failed', [
                'user_id' => Auth::id(),
                'error'   => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->with('error', 'حدث خطأ أثناء رفع العقد. حاول مرة أخرى لاحقًا.');
        }
    }
}
