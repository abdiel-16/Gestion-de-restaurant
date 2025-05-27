<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



use App\Models\Commande;
use App\Models\CommandePlat;
use App\Models\Plat;
use App\Models\Table;

use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function create()
    {
        //
    }
    public function index()
    {
        $user = Auth::user();

        $commande = Commande::where('user_id', $user->id)
                            ->where('statut', 'en_cours')
                            ->with('plats')
                            ->first();

        return view('commandeSuivi', compact('commande'));
    }




    public function store(Request $request, Plat $plat)
    {
        $user = Auth::user();

        // Chercher une commande en cours
        $commande = Commande::where('user_id', $user->id)
                            ->where('statut', 'en_cours')
                            ->first();

        // Si aucune commande en cours, en créer une
        if (!$commande) {
            $commande = Commande::create([
                'user_id' => $user->id,
                'table_id' => 1,
                'statut' => 'en_cours'
            ]);
        }

        // Vérifier si le plat est déjà attaché à cette commande
        $existant = $commande->plats()->where('plat_id', $plat->id)->first();

        if ($existant) {
            // Mettre à jour la quantité manuellement
            $commande->plats()->updateExistingPivot($plat->id, [
                'quantite' => $existant->pivot->quantite + 1,
                'updated_at' => now(),
            ]);
        } else {
            // Attacher le plat avec quantité = 1
            $commande->plats()->attach($plat->id, [
                'quantite' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return redirect()->route('admin-dashboard')->with('success', 'Plat mis à jour avec succès !');
        
    }


    public function confirmer(Request $request)
    {
    $user = auth()->user();


    $commande = $user->commandes()->where('statut', 'en_cours')->first();

    if ($commande && $commande->plats()->count() > 0) {

        $commande->statut = 'confirmee';
        $commande->save();

        return redirect()->route('accueilShow')->with('success', 'Commande confirmée avec succès !');
    }

    return redirect()->route('commande-suivi')->with('error', 'Aucune commande à confirmer.');
 
    }


    public function pret(Request $request)
    {
    $user = auth()->user();


    $commande = $user->commandes()->where('statut', 'confirmee')->first();

    if ($commande && $commande->plats()->count() > 0) {

        $commande->statut = 'pret';
        $commande->save();

        return redirect()->route('cuisinier-dashboard')->with('success', 'Commande prêt !');
    }

    return redirect()->route('cuisinier-dashboard')->with('error', 'Aucune commande à confirmer.');
 
    }

        public function servie(Request $request)
    {
    $user = auth()->user();


    $commande = $user->commandes()->where('statut', 'pret')->first();

    if ($commande && $commande->plats()->count() > 0) {

        $commande->statut = 'servie';
        $commande->save();

        return redirect()->route('serveur-dashboard')->with('success', 'Commande prêt !');
    }

    return redirect()->route('serveur-dashboard')->with('error', 'Aucune commande à confirmer.');
 
    }


}
