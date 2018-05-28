<?php

namespace App\Http\Controllers\Branches;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class setCurrentBranchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

   public function setBranch($branch_id, Request $request, Branch $branch)
    {
        $allowedBranches = $request->user()->branches()->pluck('id');

        $branch = $branch->where('id', $branch_id)->whereIn('id', $allowedBranches)->first();

        if (!$branch) {
            return redirect()->back();
        }

        $user = $request->user();
        $user->current_branch_id = $branch->id;
        $user->save();

        Session::put('branch', ['name' => $branch->name, 'id' => $branch->id]);
        return redirect()->back();
    }
}
