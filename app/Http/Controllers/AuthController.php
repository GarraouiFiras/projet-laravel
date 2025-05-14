<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password; // Importez la classe Password
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;


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
    // Affiche le formulaire de demande de lien de réinitialisation
    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    // Envoie le lien de réinitialisation par email
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    // Affiche le formulaire de réinitialisation du mot de passe
    public function showResetForm(Request $request, $token = null)
    {
        return view('reset-password')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    // Réinitialise le mot de passe de l'utilisateur
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                    
                ])->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
