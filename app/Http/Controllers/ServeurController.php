<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class ServeurController extends Controller
{
    public function dashboard(){
           $commandes = Commande::with(['table','plats'])
            ->where('statut', 'pret')
            ->get();

        return view('serveur', compact('commandes'));
    }



}
