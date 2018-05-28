<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Validator;

class ContactController extends Controller
{
    public function newContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:190',
            'message' => 'required|min:10|max:1000'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ]);
        }

        Contact::create([
            'type' => 'contact',
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ]);

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
            'message' => 'Uw bericht is ontvangen'
        ]);
    }

    public function newDemoRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|max:190',
            'bedrijfsnaam' => 'required|min:3|max:100',
            'message' => 'required|min:10|max:1000'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'hasErrors' => true,
                'errors' => $validator->errors(),
            ]);
        }

        Contact::create([
            'type' => 'demo',
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->bedrijfsnaam,
            'message' => $request->message
        ]);

        return response()->json([
            'hasErrors' => false,
            'errors' => [],
            'message' => 'Uw verzoek is ontvangen'
        ]);
    }
}
