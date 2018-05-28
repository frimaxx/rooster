<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App;
use Config;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch;
use View;

class BranchMiddleware
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
        $branch = null;

        if (!Session::has('branch')) {
            if (Auth::check() && !empty(Auth::user()->current_branch_id)) {
                $user = Auth::user();
                $user_branch = $user->current_branch_id;
                $branch = Branch::where('id', $user_branch)->where('company_id', $user->company_id)->first();
                if ($branch) {
                    Session::put('branch', ['name' => $branch->name, 'id' => $branch->id]);
                    Session::save();
                } else {
                    Session::put('branch', null);
                }
            } else {
                if (Auth::check()) {
                    $user = Auth::user();

                    $branch = $user->branches()->first();
                    if (!$branch) {
                        Session::put('branch', ['name' => 'geen', 'id' => 0]);

                        return $next($request);
                    }
                    $user->current_branch_id = $branch->id;
                    $user->save();

                    Session::put('branch', ['name' => $branch->name, 'id' => $branch->id]);
                    Session::save();
                }
            }
        }

        View::share('current_branch', \Session::get('branch'));

        return $next($request);
    }
}
