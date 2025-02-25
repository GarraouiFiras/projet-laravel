<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Affiche le formulaire de login
    public function showLoginForm()
    {
        return view('login');
    }

    // Traite la connexion de l'utilisateur
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regénère la session pour éviter le vol de session
            $request->session()->regenerate();

            // Redirige vers le dashboard après une connexion réussie
            return redirect()->route('dashboard'); // Vous pouvez changer cette ligne pour rediriger vers /dashboard ou une autre route
        }

        return back()->with('error', 'Identifiants incorrects');
    }

    // Déconnexion de l'utilisateur
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
