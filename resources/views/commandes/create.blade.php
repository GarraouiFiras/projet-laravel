@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Passer une commande</h1>

    <form action="{{ route('commandes.store') }}" method="POST">
        @csrf

        <!-- Champ pour le nom du client -->
        <div class="form-group">
            <label for="nom_client">Votre nom</label>
            <input type="text" name="nom_client" id="nom_client" class="form-control" placeholder="Entrez votre nom" required>
        </div>

        <div class="row">
            <!-- Section des voitures -->
            <div class="col-md-6">
                <h4 class="mt-4">Voitures</h4>
                @foreach($cars as $car)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <!-- Vérification et affichage de l'image -->
                                @if($car->image)
                                    <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->nom }}">
                                @else
                                    <img src="{{ asset('images/default-car.jpg') }}" class="card-img-top" alt="Image non disponible">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->name }}</h5>
                                    <p class="card-text">Prix: {{ $car->price }} €</p>
                                    <div class="form-check">
                                        <input type="radio" name="car_id" id="car_{{ $car->id }}" value="{{ $car->id }}" class="form-check-input">
                                        <label for="car_{{ $car->id }}" class="form-check-label">Sélectionner cette voiture</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Section des accessoires -->
            <div class="col-md-6">
                <h4 class="mt-4">Accessoires</h4>
                @foreach($accessoires as $accessoire)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <!-- Vérification et affichage de l'image -->
                                @if($accessoire->image)
                                    <img src="{{ asset('storage/' . $accessoire->image) }}" class="card-img-top" alt="{{ $accessoire->nom }}">
                                @else
                                    <img src="{{ asset('images/default-accessoire.jpg') }}" class="card-img-top" alt="Image non disponible">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $accessoire->nom }}</h5>
                                    <p class="card-text">Prix: {{ $accessoire->prix }} €</p>
                                    <input type="number" name="accessoires[{{ $accessoire->id }}][quantite]" value="0" min="0" class="form-control">
                                    <input type="hidden" name="accessoires[{{ $accessoire->id }}][id]" value="{{ $accessoire->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-4">Passer la commande</button>
    </form>
</div>
@endsection