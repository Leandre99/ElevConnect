<?php

namespace App\Http\Controllers;

use App\Models\User;

class VeterinaireController extends Controller
{
    public function index()
{
    $veterinaires = User::where('role', 'Vétérinaire')->where('status',1)->get();

    return view('Veterinaire', ['veterinaires' => $veterinaires]);
}

}
