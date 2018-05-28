<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Factory as ValidationFactory;
use Validator;
use Image;

class AccountSettingsController extends Controller
{
    public function __construct(ValidationFactory $validationFactory)
    {
        $this->middleware('auth', ['except' => ['loadcss']]);
        $validationFactory->extend(
            'password_match',
            function ($attribute, $value, $parameters) {
                $user = Auth::user();
                if (password_verify($value, $user->password)) {
                    return true;
                }
                return false;
            },
            'Wachtwoord onjuist.'
        );
    }

    public function index()
    {
        return view('auth.account');
    }

    public function updateEmail(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'wachtwoord' => 'required|password_match',
            'email' => 'required|email|max:190|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return redirect(route('auth.account'))->withErrors($validator)->withInput();
        }

        $user->update([
            'email' => $request->input('email')
        ]);

        flash("Email is gewijzigd", 'success');
        return redirect(route('auth.account'));
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'huidig_wachtwoord' => 'required|password_match',
            'password' => 'required|string|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return redirect(route('auth.account'))->withErrors($validator)->withInput();
        }

        $user = $request->user();
        $user->update([
           'password' => bcrypt($request->input('password'))
        ]);

        flash("Uw wachtwoord is gewijzigd", 'success');
        return redirect(route('auth.account'));
    }

    public function uploadAvatar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'avatar' => 'required|mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:3000',
        ]);
        if ($validator->fails()) {
            flash($validator->errors()->first(), 'danger');
            return redirect()->back();
        }

        $user = $request->user();

        if ($user->avatar) {
            try {
                unlink('assets/images/avatars/'.$user->avatar);
            } catch (\ErrorException $e) {
                // continue like nothing happened
            }
        }

        $avatar = $request->file('avatar');

        $hash =  $user->id  . '-' . str_random(35) . '.jpg';
        $storageLocation = 'assets/images/avatars/' . $hash;

        Image::make($avatar->getRealPath())->fit(150, 150)->save($storageLocation);

        $user->update([
            'avatar' => $hash
        ]);

        return redirect()->back();
    }
}
