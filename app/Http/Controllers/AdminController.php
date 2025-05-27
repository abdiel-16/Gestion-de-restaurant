<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plat;
use App\Models\Categorie;

class AdminController extends Controller
{
   public function dashboard()
    {
       

        $plats = Plat::with('categorie')->get();
        $personnels = User::where('role', '!=', 'client')->where('role', '!=', 'admin')->get();
        $clients = User::where('role', 'client')->get();
        $categories = Categorie::all();

        return view('admin', compact('plats', 'personnels', 'clients','categories'));
    }
    
    public function modifierRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'role' => 'required|in:admin,cuisinier,serveur,client',
        ]);

        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin-dashboard')->with('success', 'Rôle modifié avec succès');
    }

    public function supprimerUtilisateur($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->route('admin-dashboard')->with('success', 'Utilisateur supprimé avec succès');
    }

        public function formulaireAjoutUtilisateur()
    {
        return view('admin.ajouter_utilisateur');
    }

    public function ajouterUtilisateur(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,cuisinier,serveur',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return redirect()->route('admin-dashboard')->with('success', 'Utilisateur ajouté avec succès.');
    }
}

