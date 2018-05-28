<?php

namespace App\Http\Controllers\api\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Validator;

class ManageUserController extends Controller
{
    public function update($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        if (!$user || !$request->user()->canEditUser($user)) {
            return response()->json([
               'hasErrors' => true,
               'errors' => [
                   'User not found'
               ]
            ]);
        }

        $validator = Validator::make($request->all(), [
            'uren_min' => 'integer|digits_between:1,51',
            'uren_max' => 'integer|digits_between:1,51',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ]);
        }

        if ($request->input('uren_min')) {
            $user->uren_min = $request->input('uren_min');
        }
        if ($request->input('uren_max')) {
            $user->uren_max = $request->input('uren_max');
        }
        $user->save();

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
            'user' => $user->toArray()
        ]);
    }
}
