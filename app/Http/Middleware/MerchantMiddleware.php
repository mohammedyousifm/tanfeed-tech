<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            abort(403, 'غير مصرح لك بالدخول');
        }

        $user = Auth::user();

        // 🚫 لو المستخدم ليس تاجرًا
        if ($user->role !== 'merchant') {
            abort(403, 'غير مصرح لك بالدخول');
        }

        // ⚠️ لو المستخدم تاجر لكن حسابه غير نشط
        if ($user->status !== 'active') {
            return redirect()->route('not-active');
        }

        // ✅ تاجر نشط
        return $next($request);
    }
}
