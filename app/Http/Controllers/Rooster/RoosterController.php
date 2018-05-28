<?php

namespace App\Http\Controllers\Rooster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;

class RoosterController extends Controller
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

    public function index(Request $request, Branch $branch)
    {
        $curBranch = session()->get('branch');

        $employees = $branch->getEmployees($curBranch['id'])->get();

        return view('rooster.planner')->with([
            'employees' => $employees
        ]);
    }

    public function printRooster(Request $request)
    {
        return view('rooster.print_schedule')->with([
            'start' => $request->input('start'),
            'end' => $request->input('end')
        ]);
    }

}
