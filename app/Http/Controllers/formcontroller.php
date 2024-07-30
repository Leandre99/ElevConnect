<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class FormController extends Controller
{
    public function showContactForm()
    {
        return view('Contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email',
            'age' => 'required|integer|min:7|max:77',
            'position_actuelle' => 'required|in:student,veterinarian,employee,entrepreneur',
            'recommande' => 'required|integer|between:1,3',
            'plus_aime' => 'required|in:challenges,projects,community,open_source',
            'preferences' => 'nullable|string',
            'commentaires' => 'nullable|string',
        ]);

        $form = new Form();
        $form->nom = $request->input('nom');
        $form->email = $request->input('email');
        $form->age = $request->input('age');
        $form->position_actuelle = $request->input('position_actuelle');
        $form->recommande = $request->input('recommande');
        $form->plus_aime = $request->input('plus_aime');
        $form->preferences = $request->input('preferences');
        $form->commentaires = $request->input('commentaires');
        $form->save();

        return back()->with('success', 'Votre formulaire a été soumis avec succès ! Nous vous contacterons bientôt.');
    }
}
