<?php

namespace App\Http\Controllers\Managers;

use App\Models\Branch;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Helpers\Math;

class ManageUsersController extends Controller
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

    public function index(Request $request, User $userModel)
    {
        $branches = Branch::where('company_id', $request->user()->company_id)->orderBy('name', 'asc')->get();

        $query = $request->input('q');
        $branchQuery = $request->input('branch');

        $resuls = $this->searchRecords($query, $branchQuery, $userModel, $request->user());

        return view('managers.users')->with([
            'branches' => $branches,
            'users' => $resuls,
            'query' => $query,
            'branchQuery' => $branchQuery
        ]);
    }

    public function showUser($id, Request $request, User $user)
    {
        $user = $user->where('id', $id)->first();
        $curUser = $request->user();
        if ((!$user) || ($curUser->level() < 5) && ($curUser->company_id != $user->company_id) || !$request->user()->canEditUser($user)) {
            flash('Gebruiker niet gevonden', 'danger');
            return redirect(route('manage.users'));
        }

        return view('managers.user_info')->with([
            'user' => $user,
            'branches' => $user->branchesEmployee(),
            'user_branches' => $request->user()->branches(),
            'employee_branches_ids_array' => $user->branchesEmployee()->pluck('id')->toArray(),
            'manager_branches_ids_array' => $user->branches()->pluck('id')->toArray(),
            'management_branches' => $user->branches()
        ]);
    }

    /**
     * Add user to a branch
     * @param $id
     * @return boolean
     */
    public function addBranch($id, Request $request, User $user)
    {
        $user = $user->where('id', $id)->first();
        if (!$user || !$request->user()->canEditUser($user)) {
            flash('Gebruiker niet gevonden', 'danger');
            return redirect(route('manage.users'));
        }
        if ($request->user()->level() < $user->level()) {
            flash('U bent niet gemachtigd om deze gebruiker aan te passen', 'danger');
            return redirect()->back();
        }
        $allowedBranches = $request->user()->branches();
        $allowedBranchesIdsArray = $allowedBranches->pluck('id')->toArray();

        $branch = Branch::where('id', $request->input('branch'))->first();

        if (!$branch) {
            flash('Dit filiaal bestaat niet', 'danger');
            return redirect()->back();
        }
        if (!in_array($branch->id, $allowedBranchesIdsArray)) {
            flash('U kunt deze gebruiker niet in dit filiaal plaatsen', 'danger');
            return redirect()->back();
        }
        if (Employee::where('user_id', $user->id)->where('branch_id', $branch->id)->first()) {
            flash("Deze gebruiker zit al in dit filiaal", 'danger');
            return redirect()->back();
        }
        Employee::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id
        ]);
        flash("Gebruiker toegevoegd aan filiaal", 'success');
        return redirect()->back();
    }

    /**
     * Add manager to a branch
     * @param $id
     * @return boolean
     */
    public function addManagerBranch($id, Request $request, User $user)
    {
        $user = $user->where('id', $id)->first();
        if (!$user || !$request->user()->canEditUser($user)) {
            flash('Gebruiker niet gevonden', 'danger');
            return redirect(route('manage.users'));
        }
        if ($request->user()->level() < $user->level()) {
            flash('U bent niet gemachtigd om deze gebruiker aan te passen', 'danger');
            return redirect()->back();
        }
        $allowedBranches = $request->user()->branches();
        $allowedBranchesIdsArray = $allowedBranches->pluck('id')->toArray();

        $branch = Branch::where('id', $request->input('branch'))->first();

        if (!$branch) {
            flash('Dit filiaal bestaat niet', 'danger');
            return redirect()->back();
        }
        if (!in_array($branch->id, $allowedBranchesIdsArray)) {
            flash('U kunt deze gebruiker niet in dit filiaal plaatsen', 'danger');
            return redirect()->back();
        }
        if (!Employee::where('user_id', $user->id)->where('branch_id', $branch->id)->first()) {
            Employee::create([
                'user_id' => $user->id,
                'branch_id' => $branch->id
            ]);
        }
        if (Manager::where('user_id', $user->id)->where('branch_id', $branch->id)->first()) {
            flash("Gebruiker is al manager van dit filiaal", 'error');
            return redirect()->back();
        }
        Manager::create([
            'user_id' => $user->id,
            'branch_id' => $branch->id
        ]);
        if ($user->level() < 2) {
            $user->user_level = 2;
            $user->save();
        }

        flash("Manager toegevoegd aan filiaal", 'success');
        return redirect()->back();
    }

    public function deleteUserFromBranch($id, $branch_id, Request $request, User $user)
    {
        $user = $user->where('id', $id)->first();
        if (!$user || !$request->user()->canEditUser($user)) {
            flash('Gebruiker niet gevonden', 'danger');
            return redirect(route('manage.users'));
        }
        if ($request->user()->level() < $user->level()) {
            flash('U bent niet gemachtigd om deze gebruiker aan te passen', 'danger');
            return redirect()->back();
        }
        $allowedBranches = $request->user()->branches();
        $allowedBranchesIdsArray = $allowedBranches->pluck('id')->toArray();
        if (!in_array($branch_id, $allowedBranchesIdsArray)) {
            flash('U kunt deze gebruiker niet uit dit filiaal halen', 'danger');
            return redirect()->back();
        }
        $employee = Employee::where('user_id', $user->id)->where('branch_id', $branch_id)->first();
        if (!$employee) {
            flash('Gebruiker niet gevonden in dit filiaal', 'danger');
            return redirect()->back();
        }
        $employee->delete();
        flash('Gebruiker verwijderd uit het filiaal', 'success');
        return redirect()->back();
    }

    public function deleteManagerFromBranch($id, $branch_id, Request $request, User $user)
    {
        $user = $user->where('id', $id)->first();
        if (!$user || !$request->user()->canEditUser($user)) {
            flash('Gebruiker niet gevonden', 'danger');
            return redirect(route('manage.users'));
        }
        if ($request->user()->level() < $user->level()) {
            flash('U bent niet gemachtigd om deze gebruiker aan te passen', 'danger');
            return redirect()->back();
        }
        $allowedBranches = $request->user()->branches();
        $allowedBranchesIdsArray = $allowedBranches->pluck('id')->toArray();
        if (!in_array($branch_id, $allowedBranchesIdsArray)) {
            flash('U kunt deze gebruiker niet uit dit filiaal halen', 'danger');
            return redirect()->back();
        }
        $manager = Manager::where('user_id', $user->id)->where('branch_id', $branch_id)->first();
        if (!$manager) {
            flash('Manager niet gevonden in dit filiaal', 'danger');
            return redirect()->back();
        }
        $manager->delete();
        flash('Manager verwijderd uit het filiaal', 'success');

        if ($user->branches()->count() < 1 && $user->level() == 2) {
            $user->user_level = 1;
            $user->save();
        }
        return redirect()->back();
    }

    public function changeRole($id, Request $request, User $user)
    {
        $user = $user->where('id', $id)->first();
        if (!$user || !$request->user()->canEditUser($user)) {
            flash('Gebruiker niet gevonden', 'danger');
            return redirect(route('manage.users'));
        }

        $currentUserLevel = $request->user()->level();
        $newRole = $request->input('account_level');
        if ($currentUserLevel < $user->level()) {
            flash('U bent niet gemachtigd om deze gebruiker aan te passen', 'danger');
            return redirect()->back();
        }

        if ($newRole == 'admin' && $currentUserLevel > 4) {
            $user->user_level = 5;
        }
        if ($newRole == 'eigenaar' && $currentUserLevel > 3) {
            $user->user_level = 4;
        }
        if ($newRole == 'rayonManager' && $currentUserLevel > 2) {
            $user->user_level = 3;
        }
        if ($newRole == 'manager' && $currentUserLevel > 1) {
            $user->user_level = 2;
        }
        if ($newRole == 'medewerker' && $currentUserLevel > 1) {
            $user->user_level = 1;
            // delete Managment records
            Manager::where('user_id', $user->id)->delete();
        }

        $user->save();
        return redirect()->back();
    }

    public function deleteUser($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        if (!$user || !$request->user()->canEditUser($user)) {
            flash('Gebruiker niet gevonden', 'danger');
            return redirect(route('manage.users'));
        }
        $currentUser = $request->user();
        if ($currentUser->level() < 3) {
            flash('U bent niet gemachtigd om gebruikers te verwijderen', 'danger');
            return redirect()->back();
        }
        if ($currentUser->level() < $user->level()) {
            flash('U bent niet gemachtigd om deze gebruiker te verwijderen', 'danger');
            return redirect()->back();
        }
        $user->delete();
        flash('Gebruiker verwijderd', 'success');
        return redirect(route('manage.users'));
    }

    public function searchRecords($query, $branchQuery, $userModel, $user)
    {
        if ((empty($branchQuery) || $branchQuery == 'all') && strlen($query) < 2 ) {
            return null;
        }

        $result = $userModel->select('users.id', 'users.name', 'users.username', 'users.user_level');
        if (!empty($branchQuery) && $branchQuery != 'all') {
            $result = $result->where('employees.branch_id', $branchQuery)
                ->join('employees', 'employees.user_id', '=', 'users.id');
        }
        $this->query = $query;
        if (strlen($query) > 2) {
            $result = $result->where(function($q) {
                $q->orWhere('name', 'LIKE', '%' . $this->query . '%')
                    ->orWhere('username', 'LIKE', '%' . $this->query . '%')
                    ->orWhere('email', 'LIKE' . '%' . $this->query . '%');
            });
        }

        $result = $result->where('company_id', $user->company_id);

        if ($user->level() < 4) {
            $result = $result->where('user_level', '<', 4);
        }
        $result = $result->get();
        if ($user->level() < 3) {
            $branches_ids_array = Manager::where('user_id', $user->id)->get()->pluck('branch_id')->toArray();
            $allowedUsers = Employee::whereIn('branch_id', $branches_ids_array)->get()->pluck('user_id')->toArray();

            return $result->whereIn('id', $allowedUsers);
        }
        return $result;
    }

}
