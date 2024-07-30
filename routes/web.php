<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\formcontroller;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FermeController;
use App\Http\Controllers\EspeceController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VeterinaireController;
use App\Http\Controllers\PerformanceReportController;

Route::get('/', function () { return view('welcome');})->name('welcome');

Route::get('register',function(){ return view('auth/register'); });

Route::get('dashboard', function(){ return view('dashboard'); })->name('dashboard');

Route::group(['middleware' => 'auth'], function () {

    Route::get('Rapport', function() { return view('Rapport');})->name('Rapport');

    Route::get('Veterinaire', [VeterinaireController::class, 'index'])->name('Veterinaire');

    Route::get('Ferme', [FermeController::class, 'index'])->name('Ferme-index');

    Route::get('/ferme/{id}/edit', [FermeController::class, 'edit'])->name('ferme_edit');
    Route::put('/ferme/{id}', [FermeController::class, 'update'])->name('ferme.update');


});

Route::get('Contact', [FormController::class, 'showContactForm'])->name('Contact');

Route::post('form', [FormController::class, 'store'])->name('form');

Route::POST('ferme', [FermeController::class, 'store'])->name('ferme');

// Route::put('modifier', [fermeController::class, 'update'])->name('modifier');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/farms', [AdminController::class, 'indexFarms'])->name('admin.farms');
    Route::get('/admin/users', [AdminController::class, 'indexUsers'])->name('admin.users');
    Route::get('/admin/farms/{farm}/edit', [AdminController::class, 'editFarm'])->name('admin.farms.edit');
    Route::put('/admin/farms/{farm}', [AdminController::class, 'updateFarm'])->name('admin.farms.update');
    Route::delete('/admin/farms/{farm}', [AdminController::class, 'destroyFarm'])->name('admin.farms.destroy');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    Route::get('admin/{user}/activate', [AdminController::class, 'activate'])->name('admin.users.activate');
    Route::get('admin/{user}/deactivate', [AdminController::class, 'deactivate'])->name('admin.users.deactivate');


    Route::get('tasks', [TaskController::class, 'adminIndex'])->name('admin.taches');
    Route::get('tasks/create', [TaskController::class, 'adminCreate'])->name('admin.create_tache');
    Route::post('tasks', [TaskController::class, 'adminStore'])->name('admin.tasks.store');
    Route::get('tasks/{task}/edit', [TaskController::class, 'adminEdit'])->name('admin.edit_tache');
    Route::put('tasks/{task}', [TaskController::class, 'adminUpdate'])->name('admin.tasks.update');
    Route::delete('tasks/{task}', [TaskController::class, 'adminDestroy'])->name('admin.tasks.destroy');
});

// Auth::routes(['verify' => true]);

Route::get('index', [PusherController::class, 'index']);

Route::post('broadcast', [PusherController::class, 'Broadcast']);

Route::post('receive', [PusherController::class, 'receive']);

Route::get('tasks/{id}', [TaskController::class, 'index'])->name('tasks.index');

Route::patch('tasks', [TaskController::class, 'markAsCompleted'])->name('tasks.markAsCompleted');

Route::patch('/tasks/{task}/mark-as-completed', 'TaskController@markAsCompleted')->name('tasks.mark-as-completed');

Route::post('/tasks/{task}/mark-as-completed', [TaskController::class, 'markAsCompleted'])->name('tasks.mark-as-completed');

// Route::post('/reports/generate', [PerformanceReportController::class, 'generateWeeklyReport'])->name('reports.generate');

// Route::get('/reports/{ferme_id}', [PerformanceReportController::class, 'getPerformanceReports'])->name('reports.index');

Route::post('/reports/{ferme_id}', [PerformanceReportController::class, 'getPerformanceReports'])->name('reports.generate');

Route::get('/reports/{ferme_id}', [PerformanceReportController::class, 'index'])->name('reports.index');

require __DIR__.'/auth.php';


