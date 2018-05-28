<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class ChangeCompaniesController extends Controller
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

    public function changeCompany($id, Request $request)
    {
        $company = Company::where('id', $id)->first();

        if (!$company) {
            flash('Bedrijf waar u naartoe probeerd te wisselen niet gevonden', 'danger');
            return redirect()->back();
        }

        $user = $request->user();
        $user->company_id = $company->id;

        $new_branch = $request->user()->branches()->first();
        if($new_branch) {
            session()->put('branch', ['name' => $new_branch->name, 'id' => $new_branch->id]);
            $user->current_branch_id = $new_branch->id;
        } else {
            session()->put('branch', ['name' => 'geen', 'id' => 0]);
            $user->current_branch_id = null;
        }

        $user->save();

        return redirect()->back();
    }

}
