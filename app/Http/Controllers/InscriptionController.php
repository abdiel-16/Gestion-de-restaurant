<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class InscriptionController extends Controller
{

    public function index()
    {
        return view("inscription");
    }

    public function index_2(){
        return view("connexion");
    }

    public function create(Request $request )
    {
        $request->merge(['role' => 'client']);
          // Validation des données
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,client,cuisinier,serveur',
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
            
        ]);

        Auth::login($user);
        return redirect()->route('accueilShow')->with('succes','Vous êtes inscrits');

       
    }
    public function login(Request $request){

        // Validation des données
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');

        // Recherche de l'utilisateur par email ou par nom
        $user = User::where('email', $login)
                    ->orWhere('name', $login) 
                    ->first();

        if (!$user || !\Hash::check($password, $user->password)) {
            return response()->json([
                'message' => 'Nom/email ou mot de passe incorrect.',
            ], 401);
        }
         // Authentification manuelle
        Auth::login($user);
        $request->session()->regenerate(); 

        return redirect()->route('accueilShow')->with('succes','Vous êtes inscrits');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //*
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
