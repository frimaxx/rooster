<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class NewCompanyController extends Controller
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
    public function index()
    {
       return view('companies.new_company');
    }

    public function addCompany(Request $request)
    {
        $this->validate($request, [
            'naam' => 'required|min:3|max:190|unique:companies,name',
            'plaatsnaam' => 'required|min:3|max:50',
            'adres' => 'required|min:3|max:100',
            'postcode' => 'required|min:6|max:7',
            'logo' => 'mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:3000',
            'klein_logo' => 'mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:3000',
            'kleur' => 'required|max:7',
            'tekst_kleur' => 'required|max:7',
            'voornaam' => 'required|min:3|max:50',
            'achternaam' => 'required|min:3|max:50',
            'gebruikersnaam' => 'required|max:190|unique:users,username',
            'email' => 'required|max:190|unique:users,email',
            'password' => 'required|min:6|max:190|confirmed',
            'password_confirmation' => 'required|min:6|max:190',
        ]);

        $company = Company::create([
           'name' => $request->input('naam'),
           'city' => $request->input('plaatsnaam'),
           'address' => $request->input('adres'),
           'postal_code' => $request->input('postcode'),
           'logo' => null,
           'logo_small' => null,
           'primary_color' => $request->input('kleur'),
           'secondary_color' => $request->input('tekst_kleur')
        ]);

        $logo = $request->file('logo');
        if ($logo) {
            $hash =  $company->id  . '-' . str_random(40) . '.jpg';
            $storageLocation = 'assets/images/logos/' . $hash;

            Image::make($logo->getRealPath())->fit(190, 40)->save($storageLocation);

            $company->update([
                'logo' => $hash
            ]);
        }

        $small_logo = $request->file('klein_logo');
        if ($small_logo) {
            $hash =  $company->id  . '-s-' . str_random(40) . '.jpg';
            $storageLocation = 'assets/images/logos/' . $hash;

            Image::make($logo->getRealPath())->fit(80, 80)->save($storageLocation);

            $company->update([
                'logo_small' => $hash
            ]);
        }

        User::create([
            'name' => $request->input('voornaam') . ' ' . $request->input('achternaam'),
            'username' => $request->input('gebruikersnaam'),
            'email' => $request->input('email'),
            'password' =>  bcrypt($request->input('password')),
            'uren_min' => 30,
            'uren_max' => 40,
            'user_level' => 4,
            'api_token' => str_random(60),
            'company_id' => $company->id
        ]);

        flash('Het bedrijf is toegevoegd', 'success');
        return redirect(route('new.company'));
    }

}
