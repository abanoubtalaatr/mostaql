<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Factory as ViewFactory;
use Illuminate\Http\Response;

class CheckFeatureAccess
{
    protected $view;

    public function __construct(ViewFactory $view)
    {
        $this->view = $view;
    }


    public function handle(Request $request, Closure $next, $featureId)
    {
        $user = Auth::user();


        // Check if the user is subscribed to the package containing the feature
        if (!$user->isSubscribed()) {
            $message = 'انت غير مشترك في باقة لعمل هذا الاجراء';
            $view = $this->view->make('front.not_found', compact('message'));
            return new Response($view->render());
        }

        // Check if the package has the specified feature
        if (!$user->activePackage()->hasFeature($featureId)) {
            $message = 'باقاتك الحاليه لاتسمح لك بعمل هذا الاجراء برجاء شراء باقة تدعم هذا الاجراء';
            $view = $this->view->make('front.not_found', compact('message'));

            return new Response($view->render());
        }

        return $next($request);
    }
}
