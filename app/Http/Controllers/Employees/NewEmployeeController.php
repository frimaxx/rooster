<?php

namespace App\Http\Controllers\Employees;

use App\Http\Controllers\Controller;
use App\Mail\MailUserCredentials;
use App\Models\Branch;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class NewEmployeeController extends Controller
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
    public function index(Request $request, Branch $branch, Manager $manager)
    {
        $branches = $request->user()->branches();

        return view('employee.new_employee')->with([
            'branches' => $branches
        ]);
    }

    public function addEmployee(Request $request)
    {
        $this->validate($request, [
            'voornaam' => 'required|min:3|max:50',
            'achternaam' => 'required|min:3|max:50',
            'gebruikersnaam' => 'required|max:190|unique:users,username',
            'email' => 'required|max:190|unique:users,email',
            'password' => 'required|min:6|max:190|confirmed',
            'password_confirmation' => 'required|min:6|max:190',
            'uren_min' => 'required|integer|digits_between:1,51',
            'uren_max' => 'required|integer|digits_between:1,51',
            'filiaal' => 'required|exists:branches,id'
        ]);

        $user = User::create([
            'name' => $request->input('voornaam') . ' ' . $request->input('achternaam'),
            'username' => $request->input('gebruikersnaam'),
            'email' => $request->input('email'),
            'password' =>  bcrypt($request->input('password')),
            'uren_min' => $request->input('uren_min'),
            'uren_max' => $request->input('uren_max'),
            'user_level' => 1,
            'api_token' => str_random(60),
            'company_id' => $request->user()->company_id
        ]);

        Employee::create([
            'user_id' => $user->id,
            'branch_id' => $request->input('filiaal')
        ]);

        if($request->input('mail_credentials') == 'on') {
            Mail::to($request->input('email'))->send(new MailUserCredentials([
                'newUser' => [
                    'name' => $request->input('voornaam'),
                    'username' => $request->input('gebruikersnaam'),
                    'password' => $request->input('password')
                ],
                'manager_name' => request()->user()->name
            ]));
        }

        flash('Medewerker is aangemaakt', 'success');
        return Redirect()->back();
    }
}
