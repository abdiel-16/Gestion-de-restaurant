<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InscriptionController;



Route::post('/inscription', [InscriptionController:: class, 'create']);
Route::post('/connexion', [InscriptionController:: class, 'login']);