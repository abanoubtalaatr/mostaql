<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;


class UpdateLastActiveTime
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (auth()->check()) {
            auth()->user()->update(['last_active_at' => Carbon::now()]);
        }

        return $response;
    }
}
