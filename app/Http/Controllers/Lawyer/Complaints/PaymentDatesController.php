<?php

namespace App\Http\Controllers\Lawyer\Complaints;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\FollowUp;
use App\Models\User;
use App\Mail\ComplaintAcceptedNotification;
use App\Mail\ComplaintSuspendedMail;
use App\Mail\ComplaintAcceptedMail;
use App\Models\SuspendedComplaint;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class PaymentDatesController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = FollowUp::query()
            ->where('payment_commitment', true);



        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('serial_number', 'like', "%{$search}%")
                    ->orWhereHas('complaint', function ($c) use ($search) {
                        $c->where('serial_number', 'like', "%{$search}%");
                    });
            });
        }

        $FollowUps = $query->orderBy('payment_date', 'desc')->paginate(10);


        return view('dashboard.lawyer.complaints.payment-dates', compact('FollowUps', 'user'));
    }
}
