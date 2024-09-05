<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\User;
use App\Models\ferme;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{

    public function indexFarms()
        {
            $farms = Ferme::all();
            return view('admin.farms', compact('farms'));
        }

    public function indexUsers()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function editFarm(Ferme $farm)
    {
        return view('admin.edit_farm', compact('farm'));
    }

    public function updateFarm(Request $request, Ferme $farm)
    {
        $farm->update($request->all());
        return redirect()->route('admin.farms')->with('success', 'Ferme mise à jour avec succès');
    }

    public function destroyFarm(Ferme $farm)
    {
        $farm->delete();
        return redirect()->route('admin.farms')->with('success', 'Ferme supprimée avec succès');
    }

    public function editUser(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function destroyUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function activate($id)
    {
        $user = User::find($id);
        if ($user && $user->role === 'Veterinaire') {
            $user->status = true;
            $user->save();
        }
        return redirect()->route('admin.users')->with('success', 'Veterinaire activé avec succès.');
    }

    public function deactivate($id)
    {
        $user = User::find($id);
        if ($user && $user->role === 'Veterinaire') {
            $user->status = false;
            $user->save();
        }
        return redirect()->route('admin.users')->with('success', 'Veterinaire désactivé avec succès.');
    }

    public function indexAnimals()
    {
        $animals = Animal::with('race', 'ferme')->get();
        $fermes = Ferme::all();
        return view('admin.animals',['animals' => $animals, 'fermes' => $fermes]);
    }

    // public function editAnimal(Animal $animal)
    // {
    //     $fermes = Ferme::all();
    //     $races = Race::all();

    //     return view('admin.edit_animal', compact('animal', 'fermes', 'races'));
    // }


    // public function updateAnimal(Request $request, Animal $animal)
    // {

    //     $animal->update($request->all);

    //     return redirect()->route('admin.edit_animal');
    // }

    // public function destroyAnimal(Animal $animal)
    // {
    //     $animal->delete();

    //     return redirect()->route('admin.animals')->with('success', 'Animal supprimé avec succès.');
    // }
}
