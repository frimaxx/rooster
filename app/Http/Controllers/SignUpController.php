<?php

namespace App\Http\Controllers;

use App\Models\SignUp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index($token, Request $request)
    {
        $signup = SignUp::where('token', $token)->first();

        if (!$signup || Carbon::now() > Carbon::parse($signup->expire)) {
            return redirect('/login');
        }

        return view('confirm-signup')->with([
            'signup' => $signup
        ]);
    }
}
