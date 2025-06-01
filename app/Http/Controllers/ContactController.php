<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
   public function submit(Request $request)
    {
        // Adapter la validation aux champs du formulaire
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Tu peux stocker les données ici ou les envoyer par mail...

        return redirect()->route('contact.form')->with('success', 'Message envoyé avec succès !');
    }
}
