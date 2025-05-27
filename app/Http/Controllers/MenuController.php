<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie;

class MenuController extends Controller
{
    public function index()
    {
        // Récupérer les catégories avec les plats
        $categories = Categorie::with('plats')->get();

        return view('menu', compact('categories'));
    }
    
}
