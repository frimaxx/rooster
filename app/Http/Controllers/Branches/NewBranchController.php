<?php

namespace App\Http\Controllers\Branches;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Session;

class NewBranchController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('branches.new_branch');
    }

    public function addBranch(Request $request)
    {
        $this->validate($request, [
            'naam' => 'required|min:3|max:190',
            'referentie' => 'required|max:190',
            'plaatsnaam' => 'required|min:3|max:50',
            'adres' => 'required|min:3|max:100',
            'postcode' => 'required|min:6|max:7'
        ]);

        if (!$request->user()->company_id) {
            flash('U zit niet in een bedrijf', 'danger');
            return redirect()->back();
        }

        $branch = Branch::create([
            'name' => $request->input('naam'),
            'reference' => $request->input('referentie'),
            'city' => $request->input('plaatsnaam'),
            'address' => $request->input('adres'),
            'postal_code' => $request->input('postcode'),
            'company_id' => $request->user()->company_id
        ]);

        $user = $request->user();
        $user->current_branch_id = $branch->id;
        $user->save();

        Employee::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id
        ]);

        Session::put('branch', ['name' => $branch->name, 'id' => $branch->id]);

        flash("Het filiaal is aangemaakt", 'success');
        return redirect()->back();          
    }
}
