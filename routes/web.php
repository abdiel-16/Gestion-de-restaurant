<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\AccueilController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ServeurController;
use App\Http\Controllers\CuisinierController;
use App\Http\Controllers\MenuController;


Route::get('/inscription', [InscriptionController:: class, 'index']);
Route::post('/inscription', [InscriptionController:: class, 'create'])->name('inscription-B');
Route::post('/', [InscriptionController:: class, 'login'])->name('connexion-B');
Route::get('/', [InscriptionController:: class, 'index_2']);


Route::get('/accueil', [AccueilController:: class, 'index'])->name('accueilShow');


Route::post('/commande/ajouter/{id}', [CommandeController::class, 'store'])->name('commande-ajouter');
Route::get('/commande/suivi', [CommandeController::class, 'index'])->name('commande-suivi');
Route::delete('/commande/plat/{id}', [CommandeController::class, 'supprimerPlat'])->name('commande-plat-supprimer');
Route::post('/commande/confirmer', [CommandeController::class, 'confirmer'])->name('commande-confirmer');
Route::post('/commande/pret', [CommandeController::class, 'pret'])->name('commandes-pret');
Route::post('/commande/servie', [CommandeController::class, 'servie'])->name('commandes-servie');







Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin-dashboard');
Route::get('/admin/utilisateur/ajouter', [AdminController::class, 'formulaireAjoutUtilisateur'])->name('user-create');
Route::put('/admin/utilisateur/{id}/role', [AdminController::class, 'modifierRole'])->name('admin-user-role');
Route::delete('/admin/utilisateur/{id}', [AdminController::class, 'supprimerUtilisateur'])->name('admin-user-supprimer');
Route::post('/admin/utilisateur/ajouter', [AdminController::class, 'ajouterUtilisateur'])->name('user-store');





Route::get('/plats/create', [PlatController::class, 'create'])->name('plats-create');
Route::post('/plats', [PlatController::class, 'store'])->name('plats-store');
Route::get('/plats/{id}/edit', [PlatController::class, 'edit'])->name('plats-edit');
Route::put('/plats/{id}', [PlatController::class, 'update'])->name('plats-update');
Route::delete('/plats/{id}', [PlatController::class, 'destroy'])->name('plats-destroy');




Route::get('/menu', [MenuController::class, 'index'])->name('menu');
Route::get('/cuisinier', [CuisinierController::class,'index'])->name('cuisinier-dashboard');
Route::get('/serveur', [ServeurController::class, 'dashboard'])->name('serveur-dashboard');