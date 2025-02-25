<?php

namespace App\Http\Controllers;
use App\Models\Commande;
use App\Models\OrderItem;
use App\Models\Accessoire;

use Illuminate\Http\Request;

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
        $accessoires = Accessoire::all();
        return view('commandes.create', compact('accessoires'));
    }

    // Enregistrer une nouvelle commande
    public function store(Request $request)
    {
        $request->validate([
            'nom_client' => 'required|string|max:255', // Validation pour le nom du client
            'accessoires' => 'required|array', // Validation pour les accessoires
            'accessoires.*.id' => 'required|exists:accessoires,id', // Validation pour chaque accessoire
            'accessoires.*.quantite' => 'required|integer|min:1', // Validation pour la quantité
        ]);

        $total = 0;
        $commande = Commande::create([
            'nom_client' => $request->nom_client,
            'total' => 0,
            'statut' => 'en_attente',
        ]);

        foreach ($request->accessoires as $item) {
            $accessoire = Accessoire::find($item['id']);
            $total += $accessoire->prix * $item['quantite'];

            OrderItem::create([
                'commande_id' => $commande->id,
                'accessoire_id' => $item['id'],
                'quantite' => $item['quantite'],
                'prix_unitaire' => $accessoire->prix,
            ]);

            // Mettre à jour le stock de l'accessoire
            $accessoire->stock -= $item['quantite'];
            $accessoire->save();
        }

        $commande->update(['total' => $total]);

        return redirect()->route('commandes.show', $commande->id)->with('success', 'Commande passée avec succès.');
    }

    // Afficher les détails d'une commande
    public function show(Commande $commande)
    {
        return view('commandes.show', compact('commande'));
    }
}
