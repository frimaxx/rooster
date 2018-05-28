<?php

namespace App\Http\Middleware\levels;

use Closure;

class Level2Middleware
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
        if ($request->user()->level() < 2) {
            return redirect('/');
        }

        return $next($request);
    }
}
