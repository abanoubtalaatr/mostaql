<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFeatureAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $featureId)
    {
        $user = Auth::user();


        // Check if the user is subscribed to the package containing the feature
        if (!$user->isSubscribed()) {
            abort(403, 'انت غير مشترك في باقة لعمل هذا الاجراء');
        }

        // Check if the package has the specified feature
        if (!$user->activePackage()->hasFeature($featureId)) {
            abort(403, 'باقاتك الحاليه لاتسمح لك بعمل هذا الاجراء برجاء شراء باقة تدعم هذا الاجراء');
        }

        return $next($request);
    }
}
