<?php

namespace App\Http\Controllers\Branches;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;

class ManageBranchesController extends Controller
{
    public function showBranches(Request $request)
    {
        $user = $request->user();
        $q = $request->input('q');
        $this->query = $q;

        if (!empty($q)) {
            $branches = Branch::where('company_id', $user->company_id)
                    ->where(function($q) {
                        $q->orWhere('name', 'LIKE', '%' . $this->query . '%')
                        ->orWhere('city', 'LIKE', '%' . $this->query . '%')
                        ->orWhere('address', 'LIKE', '%' . $this->query . '%')
                        ->orWhere('postal_code', 'LIKE', '%' . $this->query . '%')
                        ->orWhere('reference', 'LIKE', '%' . $this->query . '%');
                    })
                ->orderBy('name', 'asc')->get();
        } else {
            $branches = Branch::where('company_id', $user->company_id)->orderBy('name', 'asc')->get();
        }

        $authorizedBranches = $request->user()->branches();
        $authorizedBranchesIdsArray = $authorizedBranches->pluck('id')->toArray();

        return view('branches.show_branches')->with([
            'branches' => $branches,
            'authorizedBranchesIdsArray' => $authorizedBranchesIdsArray,
            'query' => $q
        ]);
    }

    public function editBranch(Request $request)
    {
        $branch = Branch::where('company_id', $request->user()->company_id)->where('id', $request->input('branch'))->first();
        if (!$branch) {
            flash("Het filiaal dat u probeerd te bewerken bestaat niet", 'danger');
            return redirect(route('manage.branches'));
        }

        $validation = Validator::make($request->all(), [
            'naam' => 'required|min:3|max:190',
            'referentie' => 'required|max:190|unique:branches,reference,'.$branch->id,
            'plaatsnaam' => 'required|min:3|max:50',
            'adres' => 'required|min:3|max:100',
            'postcode' => 'required|min:6|max:7'
        ]);
        if ($validation->fails()) {
            return redirect(route('manage.branches').'#branchCollapse-'.$branch->id)->withErrors($validation)->withInput();
        }


        $branch->update([
            'name' => $request->input('naam'),
            'reference' => $request->input('referentie'),
            'city' => $request->input('plaatsnaam'),
            'address' => $request->input('adres'),
            'postal_code' => $request->input('postcode')
        ]);

        return redirect(route('manage.branches') . '#branchCollapse-'.$branch->id)->withInput([
            'branch' => $branch->id
        ]);
    }

    public function deleteBranch(Request $request)
    {
        $user = $request->user();
        $branch = Branch::where('company_id', $request->user()->company_id)->where('id', $request->input('branch'))->first();
        if (!$branch) {
            flash("Het filiaal dat u probeerd te bewerken bestaat niet", 'danger');
            return redirect(route('manage.branches'));
        }
        if ($user->level() < 4) {
            flash('U bent niet gemachtigd om dit filiaal te verwijderen');
            return redirect(route('manage.branches') . '#branchCollapse-'.$branch->id);
        }
        $branch->delete();

        flash("Het filiaal is verwijderd");
        return redirect(route('manage.branches') . '#branchCollapse-'.$branch->id);
    }
}