<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\AccessoireController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\ClientController;
//use App\Http\Controllers\Auth\ForgotPasswordController;
//use App\Http\Controllers\Auth\ResetPasswordController;



// Redirection de la racine ("/") vers la page d'accueil
Route::get('/', [PagesController::class, 'index'])->name('home');

// Routes publiques
Route::get('/home', [PagesController::class, 'index'])->name('home');
Route::get('/about', [PagesController::class, 'about']);
Route::get('/contact', [PagesController::class, 'contact']);
Route::get('/services', [PagesController::class, 'services']);

// Routes de gestion des utilisateurs - inscription et mise à jour
Route::get('/signup', [SignupController::class, 'showSignupForm'])->name('signup.show');
Route::post('/signup', [SignupController::class, 'signup'])->name('signup.store');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/users', [SignupController::class, 'index'])->name('users.index');
});
Route::delete('/users/{id}', [SignupController::class, 'destroy'])->name('users.destroy');
Route::get('/users/{id}/edit', [SignupController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [SignupController::class, 'update'])->name('users.update');

// Routes pour le login et logout
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes protégées par le middleware auth pour les produits
Route::middleware(['auth'])->group(function () {
    Route::get('/produit', [ProduitController::class, 'index'])->name('produit.index');
    Route::post('/produit', [ProduitController::class, 'store'])->name('produit.store');
});


Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//Route du maintenance 
Route::resource('maintenance', MaintenanceController::class);
// Route pour afficher le formulaire d'édition
Route::get('/maintenance/{maintenance}/edit', [MaintenanceController::class, 'edit'])
    ->name('maintenance.edit');

// Route pour traiter la mise à jour
Route::put('/maintenance/{maintenance}', [MaintenanceController::class, 'update'])
    ->name('maintenance.update');

    Route::post('/maintenance', [MaintenanceController::class, 'store'])->name('maintenance.store');


//route pour accessoires 
Route::resource('accessoires', AccessoireController::class);
//route pour commandes 
Route::resource('commandes', CommandeController::class);
Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
/*Route::middleware(['auth'])->group(function () {
    Route::put('/admin/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');
});*/


// 
Route::get('/formulaire', function () {
    // Récupère les modèles pour le formulaire (si nécessaire)
    $models = App\Models\CarModel::all();
    return view('formulaire', compact('models'));
})->name('formulaire');

// Mot de passe oublié
Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

// Réinitialisation du mot de passe
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'reset'])->name('password.update');

// Routes protégées par le middleware auth pour les statistiques
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StatisticsController::class, 'dashboardStats'])->name('dashboard');
    Route::get('/statistiques', [StatisticsController::class, 'statistics'])->name('statistics');
});

Route::middleware(['auth'])->prefix('api')->group(function () {
    Route::get('/statistics', [StatisticsController::class, 'apiStatistics']);
});


// route de clients 
// Routes protégées par middleware 'auth'
Route::middleware(['auth'])->group(function () {

    // Espace client
    Route::get('/mon-compte', [ClientController::class, 'dashboard'])->name('client.dashboard');

    // Mise à jour d'une commande (du client)
    Route::put('/mes-commandes/{commande}', [ClientController::class, 'updateCommande'])->name('client.commandes.update');

    // Gestion des rendez-vous (mise à jour et suppression)
   // Route::put('/rendezvous/{rendezvous}', [ClientController::class, 'updateRendezVous'])->name('client.rendezvous.update');
    // Ajoutez cette route avec les autres routes de votre application
Route::delete('/rendezvous/{rendezvous}', [ClientController::class, 'destroyRendezVous'])
     ->name('client.rendezvous.destroy')
     ->middleware('auth');

    // Suppression d'une commande (globale)
    Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
});










Route::get('/clients/dashboard', [ClientController::class, 'dashboard'])
     ->name('clients.dashboard');