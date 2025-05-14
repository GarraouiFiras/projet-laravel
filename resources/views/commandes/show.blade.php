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

    .card {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        color: #000;
    }

    h1 {
        color: #2c3e50;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
    }

    .card-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 1.5rem;
    }

    .card-text {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .card-text strong {
        font-weight: 600;
    }

   .table {
    background-color: rgba(255, 255, 255, 0.2); /* Plus homogène */
    backdrop-filter: blur(4px);
    border-collapse: separate;
    border-spacing: 0;
}

.table th,
.table td {
    background-color: rgba(255, 255, 255, 0.1); /* rend chaque cellule semi-transparente */
    color: #000;
    border: 1px solid rgba(0, 0, 0, 0.05);
}

.table th {
    font-weight: 600;
}

.table-hover tbody tr:hover {
    background-color: rgba(255, 255, 255, 0.2);
}
 .badge-en-attente {
    background-color: #FFA500;
    color: #000;
}

.badge-en-traitement {
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

    .badge {
        padding: 0.5em 0.75em;
        font-weight: 500;
    }

    .badge-warning {
        background-color: rgba(255, 193, 7, 0.9);
        color: #000;
    }

    .badge-success {
        background-color: rgba(40, 167, 69, 0.9);
    }

    .btn {
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border: none;
        font-weight: 500;
    }

    .btn-secondary {
        background-color: rgba(108, 117, 125, 0.8);
        color: white;
    }

    .btn-secondary:hover {
        background-color: rgba(84, 91, 98, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .product-img {
        width: 100px;
        height: auto;
        border-radius: 5px;
        object-fit: cover;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>

<div class="content-container">
    <h1 class="text-center">Détails de la commande #{{ $commande->id }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Client : {{ $commande->nom_client }}</h5>
            <p class="card-text"><strong>Total :</strong> {{ number_format($commande->total, 0, '', ' ') }} TND</p>
            <p class="card-text">
                <strong>Statut :</strong> 
                <span class="badge badge-{{ str_replace('_', '-', $commande->statut) }}">
                     {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                  </span>

            </p>
            <p class="card-text"><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>

            <h4 class="mt-4 mb-3">Produits commandés :</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Produit</th>
                        <th>Image</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($commande->commandeItems as $item)
                    <tr>
                        <td>
                            @if($item->type_produit === 'car')
                                🚗 Voiture
                            @else
                                🛠️ Accessoire
                            @endif
                        </td>
                        <td>
                            @if($item->type_produit === 'car' && $item->car)
                                {{ $item->car->name }}
                            @elseif($item->type_produit === 'accessoire' && $item->accessoire)
                                {{ $item->accessoire->nom }}
                            @else
                                <span class="text-muted">Non disponible</span>
                            @endif
                        </td>
                        <td>
                            @if($item->type_produit === 'car' && $item->car && $item->car->image)
                                <img src="{{ asset('storage/' . $item->car->image) }}" class="product-img">
                            @elseif($item->type_produit === 'accessoire' && $item->accessoire && $item->accessoire->image)
                                <img src="{{ asset('storage/' . $item->accessoire->image) }}" class="product-img">
                            @else
                                <span class="text-muted">Aucune image</span>
                            @endif
                        </td>
                        <td>{{ number_format($item->prix_unitaire, 0, '', ' ') }} TND</td>
                        <td>{{ $item->quantite }}</td>
                        <td>{{ number_format($item->prix_unitaire * $item->quantite, 0, '', ' ') }} TND</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="mt-4 text-right">
                <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Retour aux commandes
                </a>
            </div>
        </div>
    </div>
</div>
@endsection