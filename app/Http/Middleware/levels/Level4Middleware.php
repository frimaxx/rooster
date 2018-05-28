<?php

namespace App\Http\Middleware\levels;

use Closure;

class Level4Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->user()) {
            return redirect('/');
        }
        if ($request->user()->level() < 4) {
            return redirect('/');
        }

        return $next($request);
    }
}
