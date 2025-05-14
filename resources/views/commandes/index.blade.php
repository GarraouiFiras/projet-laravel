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

    /* Styles des badges - Version améliorée */
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
        background-color: rgba(255, 193, 7, 0.9) ;
        color: #000;
    }

    .badge.bg-success {
        background-color: rgba(40, 167, 69, 0.9) ;
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
</style>

<div class="content-container">
    <h1 class="text-center">
        @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
            Toutes les commandes
        @else
            Vos commandes
        @endif
    </h1>

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
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
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
                            
                            @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                                <td>{{ $commande->nom_client }}</td>
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
                <span class="badge" style="background-color: {{ $statutColors[$commande->statut] }}; color: white; padding: 5px 10px; border-radius: 10px;">
                    {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                </span>
            </td>
                            
                            <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                            
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('commandes.show', $commande->id) }}" 
                                       class="btn btn-info btn-sm">
                                       <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    @if(Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'vendeur'))
                                        <a href="{{ route('commandes.edit', $commande->id) }}" 
                                           class="btn btn-warning btn-sm">
                                           <i class="fas fa-edit"></i>
                                        </a>
                                        
                                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                    onclick="return confirm('Supprimer cette commande ?')">
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
    @endif
</div>
@endsection