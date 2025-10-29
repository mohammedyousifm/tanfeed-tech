<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;
use App\Models\Collection;
use Illuminate\Support\Facades\Log;
use Exception;

class CollectionsCollections extends Controller
{
    public function index($id)
    {
        $user =   Auth::user();
        $complaint = Complaint::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        return view('dashboard.merchant.collections.index', compact('user', 'complaint'));
    }
}
