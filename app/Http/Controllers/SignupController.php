<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class SignupController extends Controller
{
    
    public function signup(Request $request)
    {
        // Validation des données
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Créer l'utilisateur
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Rediriger ou retourner une réponse de succès
        return redirect('/home')->with('success', 'Inscription réussie !');
    }
     // Affiche une liste de ressources
     public function index()
     {
         // Récupérer tous les utilisateurs
         $users = User::all();
 
         // Retourner la vue 'users' avec les données des utilisateurs
         return view('users', compact('users'));
     }
 
     // Affiche le formulaire pour créer une nouvelle ressource
     public function create()
     {
         //
     }
 
     // Enregistre une nouvelle ressource dans la base de données
     public function store(Request $request)
     {
       // Validation des données
       $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Créer l'utilisateur
    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);

    // Rediriger vers la page d'accueil avec un message de succès
    return redirect('/')->with('success', 'Inscription réussie !');
     }
 
     // Affiche une ressource spécifique
     public function show($id)
     {
         //
     }
     public function showSignupForm()
    {
    return view('signup', ['title' => 'Inscription']);
    }
 
     // Affiche le formulaire pour modifier une ressource spécifique
     public function edit($id)
     {
        $user = User::findOrFail($id); // Trouver l'utilisateur par ID

        // Retourner la vue avec les données de l'utilisateur
        return view('users.edit', compact('user'));
     }
 
     // Met à jour une ressource spécifique dans la base de données
     public function update(Request $request, $id)
     {
        // Validation des données
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id, // Ignorer l'email actuel de l'utilisateur
    ]);

    // Trouver l'utilisateur et mettre à jour ses informations
    $user = User::findOrFail($id);
    $user->update($validatedData);

    // Rediriger vers la liste des utilisateurs avec un message de succès
    return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
     }
 
     // Supprime une ressource spécifique de la base de données
     public function destroy($id)
     {
        {
            $user = User::findOrFail($id); // Rechercher l'utilisateur par son ID
            $user->delete();               // Supprimer l'utilisateur
    
            // Rediriger avec un message de succès
            return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
        }
     }
    
}
