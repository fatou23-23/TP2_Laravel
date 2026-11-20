<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\EtudiantController;
use App\Models\Classe;
use App\Models\Etudiant;



Route::get('/', function () {
    return view('welcome');
});
Route::get('/', fn () => view('accueil', [
    'nbClasses' => Classe::count(),
    'nbEtudiants' => Etudiant::count(),
]))->name('accueil');
Route::redirect('/inscriptions', '/etudiants', 301);
Route::get('/etudiants/matricule/{matricule}', [EtudiantController::class, 'parMatricule'])
    ->where('matricule', 'ISI-[0-9]{4}-[0-9]{4}')
    ->name('etudiants.matricule');
Route::get('/annuaire/{niveau?}', [ClasseController::class, 'annuaire'])
    ->whereIn('niveau', ['L1', 'L2', 'L3', 'M1', 'M2'])
    ->name('annuaire');
Route::resource('classes', ClasseController::class)->parameters(['classes' => 'classe']);
Route::resource('etudiants', EtudiantController::class);

