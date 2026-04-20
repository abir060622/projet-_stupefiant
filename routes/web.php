<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MouvementController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Page d'accueil (Portail principal)
Route::get('/', function () {
    return view('welcome');
});

// Routes d'authentification (Login, Register, etc.)
Auth::routes();

// Groupe de routes protégées (nécessite d'être connecté)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Inventaire des médicaments
    Route::get('/inventaire', [MedicamentController::class, 'index'])->name('medicaments.index');
    Route::get('/sorties/nouvelle', [MouvementController::class, 'create'])->name('sorties.create');
Route::post('/sorties/enregistrer', [MouvementController::class, 'store'])->name('sorties.store');
    
});