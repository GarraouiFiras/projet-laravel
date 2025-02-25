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
//route pour accessoires 
Route::resource('accessoires', AccessoireController::class);
//route pour commandes 
Route::resource('commandes', CommandeController::class);
