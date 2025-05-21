@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('/assets/img/art.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
        margin: 0;
        padding: 0;
    }

    .content-container {
        background-color: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        padding: 30px;
        margin: 30px auto;
        width: 95%;
        max-width: 1200px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .table-container {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        padding: 20px;
    }

    .table {
        background-color: transparent;
        color: #000;
    }

    .table th {
        background-color: rgba(0, 0, 0, 0.1);
        color: #000;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .table td {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.3);
        vertical-align: middle;
    }

    h1 {
        color: #000;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
    }

    .alert-info {
        background-color: rgba(23, 162, 184, 0.2);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(23, 162, 184, 0.3);
    }

    /* Styles des badges */
    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.75rem;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Couleurs spécifiques pour les statuts */
    .badge-en_attente {
        background-color: #FFA500;
        color: #000;
    }

    .badge-en_traitement {
        background-color: #3490dc;
        color: white;
    }

    .badge-expediee {
        background-color: #6f42c1;
        color: white;
    }

    .badge-livree {
        background-color: #38c172;
        color: white;
    }

    .badge-annulee {
        background-color: #e3342f;
        color: white;
    }

    .badge.bg-warning {
        background-color: rgba(255, 193, 7, 0.9);
        color: #000;
    }

    .badge.bg-success {
        background-color: rgba(40, 167, 69, 0.9);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
    }

    .btn {
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border: none;
        font-weight: 500;
    }

    .btn-sm {
        padding: 0.35rem 0.65rem;
        font-size: 0.875rem;
    }

    .btn-info {
        background-color: rgba(23, 162, 184, 0.8);
    }

    .btn-warning {
        background-color: rgba(255, 193, 7, 0.8);
        color: #000;
    }

    .btn-danger {
        background-color: rgba(220, 53, 69, 0.8);
    }

    .btn-primary {
        background-color: rgba(13, 110, 253, 0.8);
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        opacity: 0.9;
    }

    /* Styles pour les filtres */
    .filter-card {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        margin-bottom: 20px;
        border: none;
    }

    .filter-card .form-control, .filter-card .btn {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .filter-card .input-group-text {
        background-color: rgba(255, 255, 255, 0.8);
    }

    @media (max-width: 768px) {
        .content-container {
            padding: 15px;
        }
        
        .filter-card .col-md-3, 
        .filter-card .col-md-2,
        .filter-card .col-md-4 {
            margin-bottom: 10px;
        }
        
        .action-buttons {
            flex-wrap: wrap;
        }

    }
</style>

<div class="content-container">
    <h1 class="text-center">
        @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
            Toutes les commandes
        @else
            Vos commandes
        @endif
    </h1>

    <!-- Message de succès -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Filtres -->
    <div class="card filter-card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('commandes.index') }}">
                <div class="row">
                    <!-- Champ de recherche -->
                    <div class="col-md-3 mb-2">
                        <input type="text" name="search" class="form-control" placeholder="Rechercher..." 
                               value="{{ request('search') }}">
                    </div>
                    
                    <!-- Filtre par statut -->
                    <div class="col-md-2 mb-2">
                        <select name="statut" class="form-control">
                            <option value="">Tous statuts</option>
                            <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                            <option value="en_traitement" {{ request('statut') == 'en_traitement' ? 'selected' : '' }}>En traitement</option>
                            <option value="expediee" {{ request('statut') == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                            <option value="livree" {{ request('statut') == 'livree' ? 'selected' : '' }}>Livrée</option>
                            <option value="annulee" {{ request('statut') == 'annulee' ? 'selected' : '' }}>Annulée</option>
                        </select>
                    </div>
                    
                    <!-- Filtre par date -->
                    <div class="col-md-3 mb-2">
                        <div class="input-group">
                            <input type="date" name="date_debut" class="form-control" 
                                   value="{{ request('date_debut') }}" placeholder="Date début">
                           
                        </div>
                    </div>
                    
                    <!-- Boutons -->
                   <!-- Remplacez la partie des boutons dans votre formulaire de filtrage par : -->
<div class="col-md-4 mb-2 d-flex align-items-center">
    <button type="submit" class="btn btn-primary mr-2" style="background-color: rgba(13, 110, 253, 0.8); border: none;">
        <i class="fas fa-filter mr-1"></i> Filtrer
    </button>
    <a href="{{ route('commandes.index') }}" class="btn" style="background-color: rgba(108, 117, 125, 0.8); color: white; border: none;">
        <i class="fas fa-times mr-1"></i> Réinitialiser
    </a>
</div>
                </div>
            </form>
        </div>
    </div>

    @if($commandes->isEmpty())
        <div class="alert alert-info text-center">
            @if(Auth::check())
                Aucune commande trouvée
            @else
                Vous n'avez pas encore passé de commande.
                <a href="{{ route('commandes.create') }}" class="btn btn-primary mt-2">Passer une commande</a>
            @endif
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom du client</th>
                        @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                            <th>Client</th>
                        @endif
                        <th>Articles</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>
                                <strong>{{ $commande->nom_client }}</strong>
                            </td>
                            
                            @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                                <td>
                                    @if($commande->user)
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <strong>{{ $commande->user->name }}</strong>
                                                <div class="text-muted small">ID: {{ $commande->user->id }}</div>
                                                <div class="text-muted small">{{ $commande->user->email }}</div>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted">Client non enregistré</span>
                                    @endif
                                </td>
                            @endif
                            
                            <td>
                                <ul class="list-unstyled">
                                    @foreach($commande->commandeItems as $item)
                                        <li>
                                            @if($item->type_produit == 'car')
                                                🚗 {{ optional($item->car)->name ?? 'Voiture non disponible' }}
                                            @else
                                                🛠️ {{ optional($item->accessoire)->nom ?? 'Accessoire non disponible' }} 
                                                <span class="badge bg-secondary">x{{ $item->quantite }}</span>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            
                            <td>{{ number_format($commande->total, 0, '', ' ') }} TND</td>
                            
                            <td>
                                <span class="badge badge-{{ $commande->statut }}">
                                    {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                </span>
                            </td>
                            
                            <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                            
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('commandes.show', $commande->id) }}" 
                                       class="btn btn-info btn-sm"
                                       title="Voir détails">
                                       <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                                        <a href="{{ route('commandes.edit', $commande->id) }}" 
                                           class="btn btn-warning btn-sm"
                                           title="Modifier">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Supprimer cette commande ?')"
                                                    title="Supprimer">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between mt-4">
            <div class="text-muted">
                Affichage de {{ $commandes->firstItem() }} à {{ $commandes->lastItem() }} sur {{ $commandes->total() }} commandes
            </div>
            <div>
                {{ $commandes->appends(request()->query())->links() }}
            </div>
        </div>
    @endif
</div>

<!-- Script pour fermer automatiquement l'alerte après 5 secondes -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let alert = document.querySelector('.alert-success');
        if (alert) {
            setTimeout(() => {
                alert.style.transition = 'opacity 1s';
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 1000);
            }, 5000);
        }
    });
</script>
@endsection