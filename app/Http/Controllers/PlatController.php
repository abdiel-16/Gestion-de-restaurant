<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Plat;
use App\Models\Categorie;
use Illuminate\Http\Request;

class PlatController extends Controller
{
  

    public function create()
    {

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        Plat::create([
            'name' => $request->name,
            'description' => $request->description,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
        ]);


        return redirect()->route('admin-dashboard')->with('success', 'Plat mis à jour avec succès !');

    }

    public function edit($id)
    {
        $plat = Plat::findOrFail($id);
        $categories = Categorie::all();
        return view('plats.edit', compact('plat', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $plat = Plat::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        $plat->update([
            'name' => $request->name,
            'description' => $request->description,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('admin-dashboard')->with('success', 'Plat mis à jour avec succès !');
    }

    public function destroy($id)
    {
        $plat = Plat::findOrFail($id);
        $plat->delete();

        return redirect()->route('admin-dashboard')->with('success', 'Plat supprimé avec succès !');
    }
}
