<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\SignUpMail;
use App\Models\Branch;
use App\Models\Company;
use App\Models\SignUp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class SignUpController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:190|unique:users',
            'bedrijfsnaam' => 'required|min:3|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ]);
        }

        $signup = SignUp::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'company_name' => $request->input('bedrijfsnaam'),
            'token' => str_random(60),
            'expire' => Carbon::now()->addDays(7)
        ]);

        Mail::to($request->input('email'))->send(new SignUpMail($signup));

        return response()->json([
            'hasErrors' => false,
            'message' => "Uw aanvraag is ontvangen, controleer uw email om de registratie te voltooien."
        ]);
    }

    public function confirmSignUp(Request $request)
    {
        $signup = SignUp::where('token', $request->input('token'))->first();

        if (!$signup || Carbon::now() > Carbon::parse($signup->expire)) {
            return response()->json([
                'hasErrors' => true,
                'message' => "invalid token"
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'username' => 'required|min:3|unique:users,username',
            'email' => 'required|min:3|unique:users',
            'password' => 'required|min:6',
            'company_name' => 'required|min:3|max:100',
            'city' => 'required|min:3',
            'postal_code' => 'required|size:6',
            'address' => 'required|min:3',
            'branch_name' => 'required|min:3|max:100',
            'branch_reference' => 'required|min:1|max:100',
            'branch_city' => 'required|min:3',
            'branch_postal_code' => 'required|size:6',
            'branch_address' => 'required|min:3',
            'confirmed' => [ Rule::in('yes')]
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ], 422);
        }

        $company = Company::create([
            'name' => $request->input('company_name'),
            'city' => $request->input('city'),
            'postal_code' => $request->input('postal_code'),
            'address' => $request->input('address'),
        ]);

        $branch = Branch::create([
            'company_id' => $company->id,
            'name' => $request->input('branch_name'),
            'reference' => $request->input('branch_reference'),
            'city' => $request->input('branch_city'),
            'postal_code' => $request->input('branch_postal_code'),
            'address' => $request->input('branch_address'),
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'email' => $signup->email,
            'password' => bcrypt($request->input('password')),
            'user_level' => 4,
            'company_id' => $company->id,
            'branch_address' => $branch->id,
            'api_token' => str_random(60),
            'uren_min' => 0,
            'uren_max' => 0
        ]);

        $signup->delete();

        return response()->json([
            'hasErrors' => false,
            'api_token' => $user->api_token
        ]);
    }

}