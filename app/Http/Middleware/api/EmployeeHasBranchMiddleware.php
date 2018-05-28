<?php

namespace App\Http\Middleware\api;

use App\Models\Branch;
use Closure;

class EmployeeHasBranchMiddleware
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
            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'Geen toegang'
                ]
            ], 403);
        }
        if (!Branch::where('id', $request->user()->current_branch_id)->first()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'U zit nog niet in een filiaal'
                ]
            ], 403);        }

        return $next($request);
    }
}
