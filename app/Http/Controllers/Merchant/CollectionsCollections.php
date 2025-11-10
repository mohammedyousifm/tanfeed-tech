<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Complaint;
use Illuminate\Support\Facades\Storage;
use App\Models\Collection;
use App\Models\MerchantCollectionView;
use App\Models\MerchantFollowupView;
use Illuminate\Support\Facades\Log;
use Exception;

class CollectionsCollections extends Controller
{
    public function index($id)
    {
        $user = Auth::user();

        $complaint = Complaint::where('id', $id)
            ->where('user_id', $user->id)
            ->firstOrFail();

        // ✅ صفّر حالة القراءة لكل التحصيلات التابعة لهذه الشكوى
        Collection::where('complaint_id', $complaint->id)
            ->update(['is_read' => true]);


        $collections = Collection::where('complaint_id', $complaint->id)->get();

        return view('dashboard.merchant.collections.index', compact('user', 'complaint'));
    }
}
