<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\User;
use App\Models\ferme;
use App\Models\Animal;
use App\Models\Espece;
use App\Models\Maladie;
use App\Models\Diagnostic;
use App\Models\Alert;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Controllers\EspeceController;

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
        $validatedData = $request->validate([
            'nomferme' => 'required|string|max:255',
            'description' => 'required|string',
            'adresse' => 'required|string|max:255',
        ]);

        $farm->update($validatedData);

        log_admin_action(
            'update_farm',
            'Ferme',
            $farm->id,
            $farm->getChanges()
        );
        return redirect()->route('admin.farms')->with('success', 'Ferme mise à jour avec succès');
    }


    public function destroyFarm(Ferme $farm)
    {
        $farm->delete();
        log_admin_action('delete_farm', 'Ferme', $farm->id, ['info' => 'suppression de la ferme']);
        return redirect()->route('admin.farms')->with('success', 'Ferme supprimée avec succès');
    }

    public function editUser(User $user)
    {
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $old = $user->getOriginal();

        $user->update($request->all());

        log_admin_action(
            'update_user',
            'User',
            $user->id,
            [
                'before' => $old,
                'after'  => $user->getChanges()
            ]
        );
        return redirect()->route('admin.users')->with('success', 'Utilisateur mis à jour avec succès');
    }

    public function destroyUser(User $user)
    {
        $id = $user->id;

        $user->delete();

        log_admin_action('delete_user', 'User', $id, ['info' => 'suppression de l’utilisateur']);
        return redirect()->route('admin.users')->with('success', 'Utilisateur supprimé avec succès');
    }

    public function activate($id)
    {
        $user = User::find($id);
        if ($user && $user->role === 'Veterinaire') {
            $user->status = true;
            $user->save();
        }
        log_admin_action('activate_veterinaire', 'User', $user->id, ['status' => 'active']);

        return redirect()->route('admin.users')->with('success', 'Veterinaire active avec succes.');
    }

    public function deactivate($id)
    {
        $user = User::find($id);
        if ($user && $user->role === 'Veterinaire') {
            $user->status = false;
            $user->save();
        }
        log_admin_action('deactivate_veterinaire', 'User', $user->id, ['status' => 'Desactive']);

        return redirect()->route('admin.users')->with('success', 'Veterinaire desactive avec succes.');
    }

    public function indexAnimals()
    {
        $animals = Animal::with('race', 'ferme')->get();
        $fermes = Ferme::all();
        return view('admin.animals', ['animals' => $animals, 'fermes' => $fermes]);
    }

    public function index()
    {
        $eleveurCount = User::where('role', 'Éleveur')->count();
        $veterinaireCount = User::where('role', 'Vétérinaire')->count();
        $farmCount = Ferme::count();
        $especeCount = Espece::count();
        $raceCount = Race::count();
        $maladieCount = Maladie::count();
        $alerteCount = Alert::count();
        $diagnosticCount = Diagnostic::count();
        $tacheCount = Tache::count();
        return view('admin/admin_dashboard', compact(
            'eleveurCount',
            'veterinaireCount',
            'farmCount',
            'especeCount',
            'raceCount',
            'maladieCount',
            'alerteCount',
            'diagnosticCount',
            'tacheCount'
        ));
    }

    public function maladiesIndex()
    {
        $maladies = Maladie::all();
        return view('admin.maladies.index', compact('maladies'));
    }

    public function maladiesCreate()
    {
        $races = Race::all();
        return view('admin.maladies.create', compact('races'));
    }

    public function maladiesStore(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'symptomes' => 'required|string',
            'race_id' => 'required|exists:races,id',
        ]);

        $maladie = Maladie::create($request->all());
        log_admin_action('create_maladie', 'Maladie', $maladie->id, $request->all());
        return redirect()->route('admin.maladies.index')->with('success', 'Maladie cree avec succès.');
    }

    public function maladiesEdit(Maladie $maladie)
    {
        $races = Race::all();
        return view('admin.maladies.edit', compact('maladie', 'races'));
    }

    public function maladiesUpdate(Request $request, Maladie $maladie)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'symptomes' => 'required|string',
            'race_id' => 'required|exists:races,id',
        ]);
        $old = $maladie->getOriginal();
        $maladie->update($request->all());

        log_admin_action('update_maladie', 'Maladie', $maladie->id, [
            'before' => $old,
            'after'  => $maladie->getChanges()
        ]);

        return redirect()->route('admin.maladies.index')->with('success', 'Maladie mise à jour.');
    }

    public function maladiesDestroy(Maladie $maladie)
    {
        $maladie->delete();
        log_admin_action('delete_maladie', 'Maladie', $maladie->id, [
    'info' => "Suppression de la maladie : {$maladie->nom}"
]);

        return redirect()->route('admin.maladies.index')->with('success', 'Maladie supprimée.');
    }

    public function diagnosticsIndex()
    {
        $diagnostics = Diagnostic::with(['ferme', 'race', 'maladie'])->get();
        return view('admin.diagnostics.index', compact('diagnostics'));
    }

    public function diagnosticsCreate()
    {
        $maladies = Maladie::all();
        return view('admin.diagnostics.create', compact('maladies'));
    }

    public function diagnosticsStore(Request $request)
    {
        $diagnostic = Diagnostic::create($request->all());
        log_admin_action('create_diagnostic', 'Diagnostic', $diagnostic->id, $request->all());
        return redirect()->route('admin.diagnostics.index');
    }

    public function diagnosticsEdit(Diagnostic $diagnostic)
    {
        $maladies = Maladie::all();
        return view('admin.diagnostics.edit', compact('diagnostic', 'maladies'));
    }

    public function diagnosticsUpdate(Request $request, Diagnostic $diagnostic)
    {
        $old = $diagnostic->getOriginal();

        $diagnostic->update($request->all());

        log_admin_action('update_diagnostic', 'Diagnostic', $diagnostic->id, [
            'before' => $old,
            'after'  => $diagnostic->getChanges()
        ]);

        return redirect()->route('admin.diagnostics.index');
    }

    public function diagnosticsDestroy(Diagnostic $diagnostic)
    {
        $diagnostic->delete();
        log_admin_action('delete_diagnostic', 'Diagnostic', $diagnostic->id);

        return redirect()->route('admin.diagnostics.index');
    }

    public function indexAlertes()
    {
        $alertes = Alert::with(['user', 'race'])->latest()->get();
        return view('admin.alertes.index', compact('alertes'));
    }

    public function showAlerte(Alert $alert)
    {
        return view('admin.alertes.edit', ['alerte' => $alert]);
    }
    public function destroyAlerte(Alert $alert)
    {
        $alert->delete();
        log_admin_action('delete_alerte', 'Alert', $alert->id);

        return redirect()->route('admin.alertes.index')->with('success', 'Alerte supprimée avec succès.');
    }
}
