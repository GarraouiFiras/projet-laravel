@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Détails de la commande #{{ $commande->id }}</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nom du client : {{ $commande->nom_client }}</h5>
            <p class="card-text"><strong>Total :</strong> {{ $commande->total }} €</p>
            <p class="card-text"><strong>Statut :</strong> {{ $commande->statut }}</p>
            <p class="card-text"><strong>Date :</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>

            <h4>Articles commandés :</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Accessoire</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commande->orderItems as $item)
                        <tr>
                            <td>{{ $item->accessoire->nom }}</td>
                            <td>{{ $item->quantite }}</td>
                            <td>{{ $item->prix_unitaire }} €</td>
                            <td>{{ $item->quantite * $item->prix_unitaire }} €</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection