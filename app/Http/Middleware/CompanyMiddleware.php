<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
use Illuminate\Support\Facades\Auth;
use View;

class CompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $company = null;
        if (Auth::check()) {
            $company = $request->user()->company();
        }

        View::share('current_company', $company);

        return $next($request);
    }
}
