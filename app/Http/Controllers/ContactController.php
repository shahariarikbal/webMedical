<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:191',
            'last_name'  => 'required|max:191',
            'phone'      => 'required|integer|min:11|max:13',
            'message'    => 'required|max:191'
        ]);

        $contact = new Contact();
        $contact->first_name = $request->first_name;
        $contact->last_name  = $request->last_name;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->email = $request->email;
        $contact->save();

        return response()->json('success', 200);
    }
}
