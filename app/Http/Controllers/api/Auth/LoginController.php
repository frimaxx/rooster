<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Lang;
use Illuminate\Support\Facades\Auth;
use File;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function login(Request $request)
    {
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'Je probeert dat te snel'
                ]
            ], 403);
        }

        $login_type = filter_var($request->input('username'), FILTER_VALIDATE_EMAIL )
            ? 'email'
            : 'username';

        $request->merge([
            $login_type => $request->input('username')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            $user = $request->user();
            if (!$user->api_token) {
                $user->api_token = str_random(40);
                $user->save();
            }

            $company = $user->company();
            if ($company->logo) {
                $company->logo_url = url('/') . '/assets/images/logos/' . $company->logo;
            }

            return response()->json([
                'hasErrors' => false,
                'errors' => [],
                'data' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'username' => $user->username,
                    'email' => $user->email,
                    'avatar' => $user->avatar,
                    'api_token' => $user->api_token,
                    'company' => $company->toArray()
                ]
            ]);
        } else {
            $this->incrementLoginAttempts($request);

            return response()->json([
                'hasErrors' => true,
                'errors' => [
                    'Ongeldige gebruikersnaam of wachtwoord'
                ]
            ], 401);
        }
    }
}
