<?php

namespace App\Http\Controllers;

use App\Models\User; // Utiliser User au lieu de Veterinaire

class VeterinaireController extends Controller
{
    public function index()
{
    $veterinaires = User::where('role', 'Vétérinaire')->where('status',1)->get(); // Filtrer par 'rôle'

    return view('Veterinaire', ['veterinaires' => $veterinaires]);
}

}
