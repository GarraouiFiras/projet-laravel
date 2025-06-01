<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
   public function signup(Request $request)
{
    // Définir un rôle par défaut (par exemple 'user')
    $request->merge(['role' => 'user']);
    
    // Validation des données
    $validatedData = $request->validate([
        'civilite' => 'required|string|in:M.,Mme,Mlle',
        'name' => 'required|string|max:255',
        'telephone' => 'required|digits:8|numeric',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Créer l'utilisateur avec rôle par défaut
    $user = User::create([
        'civilite' => $validatedData['civilite'],
        'name' => $validatedData['name'],
        'telephone' => $validatedData['telephone'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
        'role' => 'user' // Rôle par défaut
    ]);

    // Connecter automatiquement l'utilisateur 
    auth()->login($user);

    return redirect()->route('home')
         ->with('success', 'Inscription réussie ! Bienvenue '.$user->name);
}

    public function index()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function create()
    {
        // Retourne la vue pour créer un nouvel utilisateur
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'civilite' => 'required|string|in:M.,Mme,Mlle',
            'name' => 'required|string|max:255',
            'telephone' => 'required|digits:8|numeric',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user,vendeur,technicien,gestionnaire'
        ]);

        // Créer l'utilisateur
        $user = User::create([
            'civilite' => $validatedData['civilite'],
            'name' => $validatedData['name'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role']
        ]);

        // Rediriger vers la liste des utilisateurs avec un message de succès
        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès !');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function showSignupForm()
    {
        return view('signup', ['title' => 'Inscription']);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validation des données
        $validatedData = $request->validate([
            'civilite' => 'required|string|in:M.,Mme,Mlle',
            'name' => 'required|string|max:255',
            'telephone' => 'required|digits:8|numeric',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:admin,user,vendeur,technicien,gestionnaire',
            'password' => 'nullable|string|min:8'
        ]);

        // Trouver l'utilisateur et mettre à jour ses informations
        $user = User::findOrFail($id);
        
        $updateData = [
            'civilite' => $validatedData['civilite'],
            'name' => $validatedData['name'],
            'telephone' => $validatedData['telephone'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role']
        ];

        // Mettre à jour le mot de passe seulement si fourni
        if (!empty($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($updateData);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}