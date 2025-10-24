<?php

namespace App\Http\Controllers\Collector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;
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
        $complaints = Complaint::whereJsonContains('collector_ids', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);


        return view('dashboard.collector.complaints.index', compact('complaints', 'user'));
    }
}
