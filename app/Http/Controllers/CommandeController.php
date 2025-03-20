<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use App\Models\CommandeItem;
use App\Models\car; // Correction : Utiliser Car avec une majuscule
use App\Models\Accessoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    // Afficher la liste des commandes
    public function index()
    {
        $commandes = Commande::all();
        return view('commandes.index', compact('commandes'));
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

    return redirect()->route('commandes.index')->with('success', 'Commande passée avec succès.');
}

    // Afficher les détails d'une commande
    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }
    public function destroy($id)
    {
        // Trouver la commande par son ID
        $commande = Commande::findOrFail($id);

        // Supprimer les éléments de commande associés
        $commande->commandeItems()->delete();

        // Supprimer la commande elle-même
        $commande->delete();
    

        // Rediriger avec un message de succès
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }
}