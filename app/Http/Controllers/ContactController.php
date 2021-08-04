<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactsO = Contact::all();
        $contacts = [];

        foreach ($contactsO as $contacto){
            if($contacto->user_id_1 === auth()->user()->id || $contacto->user_id_2 === auth()->user()->id){
                $contacts[] = $contacto;
            }
        }

        return response()->json($contacts, 200);
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return $contact;
    }

    public function update(Request $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($request->all());
        return response()->json($contact, 200);
    }

    public function delete(Contact $contact)
    {
        $contact->delete();
        return response()->json(null, 204);
    }
}
