<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class EditCompanyController extends Controller
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


    public function index()
    {
        return view('companies.edit_company');
    }

    public function editCompany(Request $request)
    {
        $user = $request->user();

        $company = $user->company();

        $this->validate($request, [
            'naam' => 'required|min:3|max:190',
            'plaatsnaam' => 'required|min:3|max:50',
            'adres' => 'required|min:3|max:100',
            'postcode' => 'required|min:6|max:7',
            'logo' => 'mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:3000',
            'klein_logo' => 'mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:3000',
            'kleur' => 'required|max:7',
            'tekst_kleur' => 'required|max:7'
        ]);

        $new_logo = $company->logo;
        $logo = $request->file('logo');
        if ($request->input('logo_verwijderen') == 'on' || $logo) {
            try {
                unlink('assets/images/logos/'.$company->logo);
            } catch (\ErrorException $e) {
               // continue like nothing happened
            }
            $new_logo = null;
        }
        if ($logo) {
            $hash = $company->id . '-' . str_random(40) . '.png';
            $storageLocation = 'assets/images/logos/' . $hash;

            Image::make($logo->getRealPath())->fit(190, 40)->save($storageLocation);

            $new_logo = $hash;
        }

        $new_logo_small = $company->logo_small;
        $small_logo = $request->file('klein_logo');
        if ($request->input('klein_logo_verwijderen') == 'on' || $small_logo) {
            try {
                unlink('assets/images/logos/'.$company->logo_small);
            } catch (\ErrorException $e) {
                // continue like nothing happened
            }
            $new_logo_small = null;
        }
        if ($small_logo) {
            $hash =  $company->id  . '-s-' . str_random(40) . '.jpg';
            $storageLocation = 'assets/images/logos/' . $hash;

            Image::make($small_logo->getRealPath())->fit(80, 80)->save($storageLocation);

            $new_logo_small = $hash;
        }

        $company->update([
            'name' => $request->input('naam'),
            'city' => $request->input('plaatsnaam'),
            'address' => $request->input('adres'),
            'postal_code' => $request->input('postcode'),
            'logo' => $new_logo,
            'logo_small' => $new_logo_small,
            'primary_color' => $request->input('kleur'),
            'secondary_color' => $request->input('tekst_kleur'),
        ]);

        return redirect(route('edit.company'));
    }

    public function addCompany(Request $request)
    {
        $this->validate($request, [
            'naam' => 'required|min:3|max:190|unique:companies,name',
            'plaatsnaam' => 'required|min:3|max:50',
            'adres' => 'required|min:3|max:100',
            'postcode' => 'required|min:6|max:7',
            'logo' => 'mimes:jpeg,jpg,png,PNG,JPG,JPEG | max:3000',
            'kleur' => 'required|max:7',
            'tekst_kleur' => 'required|max:7'
        ]);

        $company = Company::create([
            'name' => $request->input('naam'),
            'city' => $request->input('plaatsnaam'),
            'address' => $request->input('adres'),
            'postal_code' => $request->input('postcode'),
            'logo' => null,
            'primary_color' => $request->input('kleur'),
            'secondary_color' => $request->input('tekst_kleur')
        ]);

        $logo = $request->file('logo');
        if ($logo) {
            $hash = $company->id . '-' . str_random(40) . '.png';
            $storageLocation = 'assets/images/logos/' . $hash;

            Image::make($logo->getRealPath())->fit(190, 40, array(0, 0, 0, 0))->save($storageLocation);

            $company->update([
                'logo' => $hash
            ]);
        }

        flash('Het bedrijf is toegevoegd', 'success');
        return redirect(route('new.company'));
    }

}
