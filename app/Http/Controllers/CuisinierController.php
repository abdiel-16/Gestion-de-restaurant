<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class CuisinierController extends Controller
{
    public function index()
    {
        $commandes = Commande::with(['table','plats'])
            ->where('statut', 'confirmee')
            ->get();

        return view('dashboard_cuisinier', compact('commandes'));
    }
}