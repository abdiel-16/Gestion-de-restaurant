<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/accueil', function () {
    return view('Accueil');
});

Route::get('/', function () {
    return view('inscription');
});

Route::post('/', function (Illuminate\Http\Request $request) {
    // Traitement ici : validation, sauvegarde en base, etc.
    return back()->with('success', 'Inscription réussie !');
})->name('inscription');

Route::get('/connexion', function () {
    return view('connexion');
});

Route::post('/connexion', function (Request $request) {
    $login = $request->input('connexion');
    $password = $request->input('password');

    $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nom';

    if (Auth::attempt([$field => $login, 'password' => $password])) {
        return redirect('/accueil'); 
    }

    return back()->with('error', 'Identifiants incorrects.');
})->name('connexion');


