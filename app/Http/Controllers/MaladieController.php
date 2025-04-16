<?php

namespace App\Http\Controllers;

use App\Models\Maladie;
use Illuminate\Http\Request;

class MaladieController extends Controller
{
    public function getSymptomes($id)
{
    $maladie = Maladie::findOrFail($id);
    return response()->json(['symptomes' => $maladie->symptomes]);
}

    public function index()
    {
       //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
       //
    }

}

