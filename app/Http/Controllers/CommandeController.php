<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\car; 
use App\Models\Accessoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; 

class CommandeController extends Controller
{
    // Afficher la liste des commandes
    public function index()
{
    // Définition des couleurs pour chaque statut
    $statutColors = [
        'en_attente' => '#FFA500',     // Orange
        'en_traitement' => '#3490dc',  // Bleu
        'expediee' => '#6f42c1',       // Violet
        'livree' => '#38c172',         // Vert
        'annulee' => '#e3342f'         // Rouge
    ];

    // Si l'utilisateur est admin ou vendeur
    if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur')) {
        $commandes = Commande::all();
    } 
    // Si client non connecté (session)
    elseif (Session::has('derniere_commande_id')) {
        $commandes = Commande::where('id', Session::get('derniere_commande_id'))->get();
    }
    else {
        $commandes = collect();
    }

    return view('commandes.index', [
        'commandes' => $commandes,
        'statutColors' => $statutColors
    ]);
}

    // Afficher le formulaire de création d'une commande
    public function create()
    {
        $cars = Car::all(); // Récupérer toutes les voitures
        $accessoires = Accessoire::all(); // Récupérer tous les accessoires
        return view('commandes.create', compact('cars', 'accessoires'));
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
{
    // Valider les données du formulaire
    $request->validate([
        'nom_client' => 'required|string|max:255',
        'car_id' => 'required|integer|exists:car,id', // Validation pour la voiture sélectionnée
        'accessoires' => 'nullable|array',
        'accessoires.*.id' => 'required|integer|exists:accessoires,id',
        'accessoires.*.quantite' => 'required|integer|min:0',
    ]);

    // Initialisation du total
    $total = 0;

    // Créer la commande
    $commande = Commande::create([
        'nom_client' => $request->nom_client,
        'total' => 0, // Initialisation, sera mis à jour plus tard
        'statut' => 'en_attente',
    ]);

    // Ajouter la voiture à la commande
    $car = Car::find($request->car_id);
    if ($car) {
        $total += $car->price;

        CommandeItem::create([
            'commande_id' => $commande->id,
            'type_produit' => 'car',
            'produit_id' => $car->id,
            'quantite' => 1, // Une seule voiture
            'prix_unitaire' => $car->price,
            'image' => $car->image,
        ]);
    }

    // Ajouter les accessoires à la commande
    if (!empty($request->accessoires)) {
        foreach ($request->accessoires as $item) {
            if ($item['quantite'] > 0) { // Ignorer les accessoires avec une quantité de 0
                $accessoire = Accessoire::find($item['id']);

                if ($accessoire) {
                    $total += $accessoire->prix * $item['quantite'];

                    CommandeItem::create([
                        'commande_id' => $commande->id,
                        'type_produit' => 'accessoire',
                        'produit_id' => $accessoire->id,
                        'quantite' => $item['quantite'],
                        'prix_unitaire' => $accessoire->prix,
                        'image' => $accessoire->image,
                    ]);
                }
            }
        }
    }

    // Mise à jour du total dans la commande
    $commande->update(['total' => $total]);
    // Stocker l'ID de la commande dans la session
    Session::put('derniere_commande_id', $commande->id);


    return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès.');
}

   // Afficher les détails d'une commande
   public function show(Commande $commande)
   {
       // Autoriser admin/vendeur ou vérifier l'appartenance de la commande
       if (Auth::check() && in_array(Auth::user()->role, ['admin', 'vendeur'])) {
           return view('commandes.show', compact('commande'));
       }

       if (Session::get('derniere_commande_id') != $commande->id) {
           abort(403, 'Accès non autorisé à cette commande');
       }

       return view('commandes.show', compact('commande'));
   }
   public function edit(Commande $commande)
      {
        // Vérifier les autorisations
         if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'vendeur'])) {
        abort(403, 'Accès non autorisé');
     }
    

    return view('commandes.edit', [
        'commande' => $commande,
        'statuts' => [
            'en_attente' => 'En attente',
            'en_traitement' => 'En traitement',
            'expediee' => 'Expédiée',
            'livree' => 'Livrée',
            'annulee' => 'Annulée'
        ]
    ]);
}
public function update(Request $request, Commande $commande)
{
    // Vérifier les autorisations
    if (!auth()->check() || !in_array(auth()->user()->role, ['admin', 'vendeur'])) {
        abort(403, 'Accès non autorisé');
    }

    $validated = $request->validate([
        'statut' => 'required|in:en_attente,en_traitement,expediee,livree,annulee'
    ]);

    $commande->update($validated);

    return redirect()->route('commandes.index')
                    ->with('success', 'Statut de la commande mis à jour avec succès');
}

   // Supprimer une commande
   public function destroy(Commande $commande)
   {
       // Autoriser admin ou vérifier l'appartenance de la commande
       if (Auth::check() && Auth::user()->role === 'admin') {
           $commande->commandeItems()->delete();
           $commande->delete();
           return redirect()->route('commandes.index')->with('success', 'Commande supprimée.');
       }

       if (Session::get('derniere_commande_id') != $commande->id) {
           abort(403, 'Accès non autorisé');
       }

       $commande->commandeItems()->delete();
       $commande->delete();
       Session::forget('derniere_commande_id');

       return redirect()->route('commandes.index')->with('success', 'Votre commande a été annulée.');
   }
}