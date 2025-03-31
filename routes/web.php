<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\formcontroller;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\FermeController;
use App\Http\Controllers\TacheController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\EspeceController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VeterinaireController;
use App\Http\Controllers\CompletedTaskController;
use App\Http\Controllers\PerformanceReportController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('register', function () {
    return view('auth/register');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('Veterinaire', [VeterinaireController::class, 'index'])->name('Veterinaire');
    Route::get('/fermes', [FermeController::class, 'index'])->name('Ferme');
});

Route::get('Contact', [FormController::class, 'showContactForm'])->name('Contact');
Route::post('form', [FormController::class, 'store'])->name('form');
Route::POST('ferme', [FermeController::class, 'store'])->name('ferme');
Route::get('/fermes/{id}/edit', [FermeController::class, 'edit'])->name('fermes.edit');
Route::put('/fermes/{ferme}', [FermeController::class, 'update'])->name('fermes.update');
Route::get('fermes/{ferme}/animaux', [AnimalController::class, 'index'])->name('animals.index');
Route::delete('fermes/{ferme}/animaux/{animal}', [AnimalController::class, 'destroy'])->name('animals.destroy');
Route::get('races/{espece_id}', [AnimalController::class, 'getRaces'])->name('races.get');
Route::get('/fermes/{ferme}/animaux/create', [AnimalController::class, 'create'])->name('animals.create');
Route::post('fermes/{ferme}/animals', [AnimalController::class, 'store'])->name('animals.store');
Route::get('/api/especes/{espece}/races', [EspeceController::class, 'getRaces']);
Route::patch('/fermes/{ferme}', [FermeController::class, 'destroy'])->name('fermes.destroy');
Route::get('/animaux/{animal}/edit', [AnimalController::class, 'edit'])->name('animals.edit');
Route::put('/animaux/{animal}', [AnimalController::class, 'update'])->name('animals.update');
Route::get('/especes/{espece}/races', [TaskController::class, 'getRacesBySpecies']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/farms', [AdminController::class, 'indexFarms'])->name('admin.farms');
    Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users');
    Route::get('/admin/farms/{farm}/edit', [AdminController::class, 'editFarm'])->name('admin.farms.edit');
    Route::put('/admin/farms/{farm}', [AdminController::class, 'updateFarm'])->name('admin.farms.update');
    Route::patch('/admin/fermes/{ferme}/activate', [FermeController::class, 'activate'])->name('admin.farms.activate');
    Route::patch('/admin/fermes/{ferme}/deactivate', [FermeController::class, 'deactivate'])->name('admin.farms.deactivate');
    Route::patch('/admin/farms/{farm}/toggle', [FermeController::class, 'toggleStatus'])->name('admin.farms.toggleStatus');
    Route::get('/admin/farms/{farm}/animals', [FermeController::class, 'showAnimals'])->name('admin.farms.show');

    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('admin/{user}/activate', [AdminController::class, 'activate'])->name('admin.users.activate');
    Route::get('admin/{user}/deactivate', [AdminController::class, 'deactivate'])->name('admin.users.deactivate');

    Route::get('/admin/animals', [AdminController::class, 'indexAnimals'])->name('admin.animals');
    Route::get('admin/animals/{id}/edit', [AnimalController::class, 'editAdminAnimal'])->name('admin.animals.edit');
    Route::put('admin/animals/{animal}', [AnimalController::class, 'updateAdminAnimal'])->name('admin.animals.update');
    Route::delete('admin/animals/{id}', [AnimalController::class, 'destroyAdminAnimal'])->name('admin.animals.destroy');

    Route::get('tasks', [TaskController::class, 'adminIndex'])->name('admin.taches');
    Route::get('tasks/create', [TaskController::class, 'adminCreate'])->name('admin.create_tache');
    Route::post('tasks', [TaskController::class, 'adminStore'])->name('admin.tasks.store');
    Route::get('tasks/{task}/edit', [TaskController::class, 'adminEdit'])->name('admin.edit_tache');
    Route::put('tasks/{task}', [TaskController::class, 'adminUpdate'])->name('admin.tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'adminDestroy'])->name('admin.tasks.destroy');

Route::get('/admin/especes', [EspeceController::class, 'index'])->name('admin.especes.index');
Route::get('/admin/especes/create', [EspeceController::class, 'create'])->name('admin.especes.create');
Route::post('/admin/especes', [EspeceController::class, 'store'])->name('admin.especes.store');
Route::get('/admin/especes/{espece}/edit', [EspeceController::class, 'edit'])->name('admin.especes.edit');
Route::put('/admin/especes/{espece}', [EspeceController::class, 'update'])->name('admin.especes.update');
Route::delete('/admin/especes/{espece}', [EspeceController::class, 'destroy'])->name('admin.especes.destroy');

Route::get('/admin/races', [RaceController::class, 'index'])->name('admin.races.index');
Route::get('/admin/races/create', [RaceController::class, 'create'])->name('admin.races.create');
Route::post('/admin/races', [RaceController::class, 'store'])->name('admin.races.store');
Route::get('/admin/races/{race}/edit', [RaceController::class, 'edit'])->name('admin.races.edit');
Route::put('/admin/races/{race}', [RaceController::class, 'update'])->name('admin.races.update')
Route::delete('/admin/races/{race}', [RaceController::class, 'destroy'])->name('admin.races.destroy');


});

Route::get('index', [PusherController::class, 'index']);
Route::post('broadcast', [PusherController::class, 'Broadcast']);
Route::post('receive', [PusherController::class, 'receive']);
Route::post('/reports/{ferme_id}', [PerformanceReportController::class, 'getPerformanceReports'])->name('reports.generate');
Route::get('/reports/{ferme_id}', [PerformanceReportController::class, 'index'])->name('reports.index');

Route::resource('completed_tasks', CompletedTaskController::class);
Route::post('alerts/store', [AlertController::class, 'store'])->name('alerts.store');
Route::post('alerts/{alert}/intervene', [AlertController::class, 'intervene'])->name('alerts.intervene');

Route::middleware(['veterinaire'])->group(function () {
Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
});

Route::get('ferme/{ferme_id}/animal/{animal_id}', [AnimalController::class, 'createTaskForAnimal'])->name('generatetache');
Route::get('taches/{id}', [TacheController::class, 'index'])->name('tasks.index');
Route::patch('taches/{tache}/mark-as-completed', [TacheController::class, 'markAsCompleted'])->name('taches.mark-as-completed');

Route::post('/meeting/schedule', [MeetingController::class, 'schedule'])->name('meeting.schedule');
// Route::get('/intervenir/{id}', [InterventionController::class, 'intervenir'])->name('intervenir');
require __DIR__ . '/auth.php';
