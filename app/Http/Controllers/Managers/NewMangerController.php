<?php

namespace App\Http\Controllers\Managers;

use App\Mail\MailUserCredentials;
use App\Models\Employee;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use App\Models\Branch;

class NewMangerController extends Controller
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
    public function index(Request $request, Branch $branch)
    {
        $branches = $request->user()->branches();

        return view('managers.new_manager')->with([
            'branches' => $branches
        ]);
    }

    public function addManager(Request $request)
    {
        $this->validate($request, [
            'voornaam' => 'required|min:3|max:50',
            'achternaam' => 'required|min:3|max:50',
            'gebruikersnaam' => 'required|max:190|unique:users,username',
            'email' => 'required|max:190|unique:users,email',
            'password' => 'required|min:6|max:190|confirmed',
            'password_confirmation' => 'required|min:6|max:190',
            'filiaal' => 'required|exists:branches,id'
        ]);

        $user = User::create([
            'name' => $request->input('voornaam') . ' ' . $request->input('achternaam'),
            'username' => $request->input('gebruikersnaam'),
            'email' => $request->input('email'),
            'password' =>  bcrypt($request->input('password')),
            'uren_min' => 30,
            'uren_max' => 40,
            'user_level' => 2,
            'api_token' => str_random(60),
            'company_id' => $request->user()->company_id
        ]);

        Manager::create([
           'user_id' => $user->id,
           'branch_id' => $request->input('filiaal')
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

        flash('Manager is aangemaakt', 'success');
        return redirect()->back();
    }

}
