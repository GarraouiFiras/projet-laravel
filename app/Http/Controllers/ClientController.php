<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Commande;
use App\Models\Maintenance;
use App\Models\car;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
public function dashboard(Request $request)
{
    $user = Auth::user();
    
    // Récupération des commandes avec pagination
    $commandes = $user->commandes()
        ->with(['commandeItems.car', 'commandeItems.accessoire'])
        ->latest()
        ->paginate(5);

    // Récupération des rendez-vous de l'utilisateur
        $rendezvous = Maintenance::where('user_id', $user->id)
            ->latest()
            ->paginate(5);

    // Définition des couleurs de statut
    $statutColors = [
        'en_attente' => '#FFA500',
        'pending' => '#FFA500',
        'en_traitement' => '#3490dc', 
        'expediee' => '#6f42c1',
        'livree' => '#38c172',
        'annulee' => '#e3342f',
        'cancelled' => '#e3342f'
    ];

    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'content' => view('clients.partials.dashboard_content', [
                'commandes' => $commandes,
                'rendezvous' => $rendezvous,
                'statutColors' => $statutColors,
                'user' => $user,
                'is_ajax' => true
            ])->render()
        ]);
    }

    return view('clients.dashboard', [
        'commandes' => $commandes,
        'rendezvous' => $rendezvous,
        'statutColors' => $statutColors,
        'user' => $user,
        'showClientDashboard' => true
    ]);
}

public function updateCommande(Request $request, Commande $commande)
    {
        // Vérifier que la commande appartient bien à l'utilisateur
        if ($commande->user_id !== Auth::id()) {
             if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Action non autorisée'
                ], 403);
            }
            abort(403, 'Action non autorisée');
        }

        // Seules les commandes en attente peuvent être modifiées
        if (!in_array($commande->statut, ['en_attente', 'pending'])) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Seules les commandes en attente peuvent être modifiées'
                ], 403);
            }
            return back()->with('error', 'Seules les commandes en attente peuvent être modifiées');
        }

        $validated = $request->validate([
            'statut' => 'required|in:en_attente,annulee,pending,cancelled'
        ]);

        $commande->update($validated);

                if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Statut de la commande mis à jour',
                'statut' => $commande->statut,
                'statut_color' => $this->getStatusColor($commande->statut)
            ]);
        }


        return back()->with('success', 'Statut de la commande mis à jour');
    }

    public function destroyCommande(Request $request, Commande $commande)
{
    // Vérifier que la commande appartient bien à l'utilisateur
    if ($commande->user_id !== Auth::id()) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée'
            ], 403);
        }
        abort(403, 'Action non autorisée');
    }

    // Seules les commandes en attente/pending peuvent être supprimées
    if (!in_array($commande->statut, ['en_attente', 'pending'])) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Seules les commandes en attente peuvent être supprimées'
            ], 403);
        }
        return back()->with('error', 'Seules les commandes en attente peuvent être supprimées');
    }

    DB::beginTransaction();
    try {
        // Supprimer les éléments associés
        $commande->commandeItems()->delete();
        
        // Supprimer la commande
        $commande->delete();

        DB::commit();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Commande supprimée avec succès'
            ]);
        }

        return back()->with('success', 'Commande supprimée avec succès');

    } catch (\Exception $e) {
        DB::rollBack();
        
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ], 500);
        }

        return back()->with('error', 'Erreur lors de la suppression: ' . $e->getMessage());
    }
}

    public function updateRendezVous(Request $request, Maintenance $rendezvous)
    {
        // Vérifier que le rendez-vous appartient à une voiture de l'utilisateur
        $userCarIds = $this->getUserCarIds();

        if (!$userCarIds->contains($rendezvous->car_id)) {
            abort(403, 'Action non autorisée');
        }

        // Seuls les rendez-vous en attente/pending peuvent être modifiés
        if (!in_array($rendezvous->statut, ['en_attente', 'pending'])) {
            return back()->with('error', 'Seuls les rendez-vous en attente peuvent être modifiés');
        }

        $validated = $request->validate([
            'date_rdv' => 'required|date|after:now',
            'heure_rdv' => 'required|date_format:H:i'
        ]);

        $rendezvous->update($validated);

        return back()->with('success', 'Rendez-vous mis à jour');
    }

public function destroyRendezVous(Request $request, Maintenance $maintenance)
{
    // 1. Vérification que le rendez-vous appartient bien au client
    if ($maintenance->user_id !== Auth::id()) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Action non autorisée'
            ], 403);
        }
        return back()->with('error', 'Action non autorisée');
    }

    // 2. Vérification que le statut est bien 'pending' (uniquement pour les clients)
    if ($maintenance->status !== 'pending') {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous ne pouvez annuler que les rendez-vous en attente'
            ], 403);
        }
        return back()->with('error', 'Vous ne pouvez annuler que les rendez-vous en attente');
    }

    // 3. Suppression du rendez-vous
    try {
        $maintenance->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Rendez-vous annulé avec succès',
                'redirect' => route('clients.dashboard')
            ]);
        }

        return redirect()->route('clients.dashboard')
               ->with('success', 'Rendez-vous annulé avec succès');

    } catch (\Exception $e) {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'annulation: ' . $e->getMessage()
            ], 500);
        }
        return back()->with('error', 'Erreur lors de l\'annulation: ' . $e->getMessage());
    }
}
    private function getStatusColor($status)
    {
        $colors = [
            'en_attente' => '#FFA500',
            'pending' => '#FFA500',
            'en_traitement' => '#3490dc',
            'expediee' => '#6f42c1',
            'livree' => '#38c172',
            'annulee' => '#e3342f',
            'cancelled' => '#e3342f'
        ];

        return $colors[$status] ?? '#6c757d';
    }

    /**
     * Récupère les IDs des voitures de l'utilisateur
     */
   /* private function getUserCarIds()
    {
        return Auth::user()->commandes()
            ->with('commandeItems')
            ->get()
            ->flatMap(function ($commande) {
                return $commande->commandeItems
                    ->where('type_produit', 'car')
                    ->pluck('produit_id');
            });
    }*/
}