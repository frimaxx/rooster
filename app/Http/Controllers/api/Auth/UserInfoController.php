<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use File;

class UserInfoController extends Controller
{

    public function index(Request $request)
    {
        $user = $request->user();

        $company = $user->company();
        if ($company->logo) {
            $company->logo_url = url('/') . '/assets/images/logos/' . $company->logo;
        }

        return response()->json([
           'hasErrors' => false,
           'errors' => [],
           'data' => [
               'name' => $user->name,
               'username' => $user->username,
               'email' => $user->email,
               'avatar' => $user->avatar,
               'api_token' => $user->api_token,
               'company' => $company->toArray()
           ]
        ], 200);
    }

}
