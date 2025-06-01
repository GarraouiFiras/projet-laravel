<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Support\Facades\DB;
use App\Models\CommandeItem;
use App\Models\car;
use App\Models\Accessoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CommandeController extends Controller
{
    // Afficher la liste des commandes
    public function index(Request $request)
    {
        // Définition des couleurs pour chaque statut
        $statutColors = [
            'en_attente' => '#FFA500',
            'en_traitement' => '#3490dc',
            'expediee' => '#6f42c1',
            'livree' => '#38c172',
            'annulee' => '#e3342f'
        ];

        // Construction de la requête
        $query = Commande::query();

        // Filtrage selon le rôle
        if (Auth::check()) {
            if (Auth::user()->role === 'client') {
                $query->where('user_id', Auth::id());
            }
        } elseif (Session::has('derniere_commande_id')) {
            $query->where('id', Session::get('derniere_commande_id'));
        } else {
            $query->where('id', -1); // Aucun résultat
        }
        // Filtre par statut
    if ($request->filled('statut')) {
        $query->where('statut', $request->statut);
    }

    // Filtre par date
    if ($request->filled('date_debut')) {
        $query->whereDate('created_at', '>=', $request->date_debut);
    }
    if ($request->filled('date_fin')) {
        $query->whereDate('created_at', '<=', $request->date_fin);
    }

            if ($request->filled('search')) {
        $query->where(function($q) use ($request) {
            $q->where('nom_client', 'like', '%'.$request->search.'%')
              ->orWhere('id', $request->search);
        });
    }


        // Pagination
        $commandes = $query->with(['commandeItems.car', 'commandeItems.accessoire'])
                          ->latest()
                          ->paginate(10);

        if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'content' => view('commandes.partial', [
                'commandes' => $commandes,
                'statutColors' => $statutColors
            ])->render()
        ]);
    }

    return view('commandes.index', compact('commandes', 'statutColors'));
    }

    // Afficher le formulaire de création
   public function create(Request $request) // Ajoutez Request $request en paramètre
{
    $cars = Car::all();
    $accessoires = Accessoire::where('stock', '>', 0)->get();
    
 if (request()->expectsJson() || request()->ajax()) {
        return view('commandes.partials.create', [
            'cars' => $cars,
            'accessoires' => $accessoires,
            'is_partial' => true
        ]);
    }

    return view('commandes.create', compact('cars', 'accessoires'));
}

    // Enregistrer une nouvelle commande
   // Enregistrer une nouvelle commande (version AJAX/vues partielles)
public function store(Request $request)
{
    // Valider les données du formulaire
    $validated = $request->validate([
        'car_id' => 'required|integer|exists:car,id',
        'accessoires' => 'nullable|array',
        'accessoires.*.id' => 'required|integer|exists:accessoires,id',
        'accessoires.*.quantite' => 'required|integer|min:0',
    ]);

    try {
        // Initialisation du total
        $total = 0;
         // Récupérer le nom de l'utilisateur connecté ou "Client anonyme"
        $nomClient = Auth::check() ? Auth::user()->name : 'Client anonyme';

        // Créer la commande
        $commande = Commande::create([
            'nom_client' => $nomClient,
            'total' => 0,
            'statut' => 'en_attente',
            'user_id' => Auth::id() ,
        ]);

        // Ajouter la voiture à la commande
        $car = Car::find($validated['car_id']);
        if ($car) {
            $total += $car->price;

            CommandeItem::create([
                'commande_id' => $commande->id,
                'type_produit' => 'car',
                'produit_id' => $car->id,
                'quantite' => 1,
                'prix_unitaire' => $car->price,
                'image' => $car->image,
            ]);
        }

        // Ajouter les accessoires à la commande
        if (!empty($validated['accessoires'])) {
            foreach ($validated['accessoires'] as $item) {
                if ($item['quantite'] > 0) {
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

        // Mise à jour du total
        $commande->update(['total' => $total]);
        Session::put('derniere_commande_id', $commande->id);

        // Réponse JSON pour requête AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Commande passée avec succès',
                'redirect' => route('client.dashboard'), 
                'commande_id' => $commande->id
            ]);
        }

        // Fallback pour requête normale
        return redirect()->route('client.dashboard')
                       ->with('success', 'Votre commande #'.$commande->id.' a été passée avec succès!');

    } catch (\Exception $e) {
        // Gestion des erreurs
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création de la commande: ' . $e->getMessage()
            ], 500);
        }

        return back()->with('error', 'Erreur lors de la création de la commande');
    }
}
    // Afficher une commande
   public function show(Request $request, Commande $commande)
    {
        if (Auth::check()) {
            if (!in_array(Auth::user()->role, ['admin', 'vendeur']) && $commande->user_id !== Auth::id()) {
                abort(403);
            }
        } elseif (Session::get('derniere_commande_id') != $commande->id) {
            abort(403);
        }

        $commande->load(['commandeItems.car', 'commandeItems.accessoire']);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'content' => view('commandes.show_partial', compact('commande'))->render()
            ]);
        }

        return view('commandes.show', compact('commande'));
    }
    // Afficher le formulaire d'édition
   // Afficher le formulaire d'édition
    public function edit(Request $request, Commande $commande)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'vendeur'])) {
            abort(403);
        }

        $statuts = [
            'en_attente' => 'En attente',
            'en_traitement' => 'En traitement',
            'expediee' => 'Expédiée',
            'livree' => 'Livrée',
            'annulee' => 'Annulée'
        ];

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'content' => view('commandes.edit_partial', compact('commande', 'statuts'))->render()
            ]);
        }

        return view('commandes.edit', compact('commande', 'statuts'));
    }

    // Mettre à jour une commande
    public function update(Request $request, Commande $commande)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, ['admin', 'vendeur'])) {
            abort(403);
        }

        $validated = $request->validate([
            'statut' => 'required|in:en_attente,en_traitement,expediee,livree,annulee'
        ]);

        $commande->update($validated);

        if ($request->ajax()) {
            return response()->json([
                'message' => 'Statut mis à jour',
                'statut' => $commande->statut
            ]);
        }

        return redirect()->route('commandes.index')
                       ->with('success', 'Statut mis à jour');
    }

    // Supprimer une commande
  public function destroy(Request $request, Commande $commande)
{
    // Autoriser admin/vendeur OU le propriétaire si commande en attente
    if (!Auth::check()) {
        abort(403, 'Action non autorisée');
    }

    $user = Auth::user();
    
    if (!in_array($user->role, ['admin', 'vendeur'])) {
        // Pour les clients : vérifier propriété et statut
        if ($commande->user_id !== $user->id || $commande->statut !== 'en_attente') {
            abort(403, 'Vous ne pouvez supprimer que vos commandes en attente');
        }
    }

    DB::beginTransaction();
    try {
        $commande->commandeItems()->delete();
        $commande->delete();

        DB::commit();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Commande supprimée'
            ]);
        }

        // Redirection différente selon le rôle
        if (in_array($user->role, ['admin', 'vendeur'])) {
            return redirect()->route('commandes.index')
                           ->with('success', 'Commande supprimée avec succès');
        } else {
            return redirect()->route('client.dashboard')
                           ->with('success', 'Votre commande a été annulée');
        }

    } catch (\Exception $e) {
        DB::rollBack();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression'
            ], 500);
        }

        return back()->with('error', 'Erreur lors de la suppression');
    }
}

    
}