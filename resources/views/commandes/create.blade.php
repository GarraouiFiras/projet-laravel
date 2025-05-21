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
        display: flex;
        flex-direction: column;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: -1;
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
        flex: 1;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        border: none;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .card-img-top {
        height: 150px;
        object-fit: cover;
        width: 100%;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: rgba(13, 110, 253, 0.8);
        border: none;
        padding: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: rgba(11, 94, 215, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(41, 128, 185, 0.4);
    }

    h1, h4 {
        color: #000;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        font-weight: 700;
    }

    .price {
        font-weight: bold;
        color: #2c3e50;
        font-size: 1.1em;
    }

    footer {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
        padding: 20px 0;
        backdrop-filter: blur(5px);
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

    .badge.bg-secondary {
        background-color: rgba(108, 117, 125, 0.9);
    }

    .input-group-text {
        background-color: rgba(255, 255, 255, 0.9);
    }

    @media (max-width: 768px) {
        .content-container {
            padding: 20px;
            margin: 15px auto;
        }
        
        .card-img-top {
            height: 120px;
        }
    }
</style>

<div class="content-container">
    <h1 class="text-center my-4">Passer une commande</h1>

    <form action="{{ route('commandes.store') }}" method="POST">
        @csrf

        <!-- Champ pour le nom du client 
        <div class="form-group">
            <label for="nom_client">Votre nom</label>
            <input type="text" name="nom_client" id="nom_client" class="form-control" placeholder="Entrez votre nom" required>
        </div>-->

        <div class="row">
            <!-- Section des voitures -->
            <div class="col-md-6">
                <h4 class="mt-4 mb-3" style="border-bottom: 2px solid rgba(13, 110, 253, 0.8); padding-bottom: 8px;">Voitures</h4>
                @foreach($cars as $car)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                @if($car->image)
                                    <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->nom }}">
                                @else
                                    <img src="{{ asset('images/default-car.jpg') }}" class="card-img-top" alt="Image non disponible">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->name }}</h5>
                                    <p class="card-text price">{{ number_format($car->price, 0, '', ' ') }} TND</p>
                                    <div class="form-check">
                                        <input type="radio" name="car_id" id="car_{{ $car->id }}" value="{{ $car->id }}" class="form-check-input" required>
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
                <h4 class="mt-4 mb-3" style="border-bottom: 2px solid rgba(13, 110, 253, 0.8); padding-bottom: 8px;">Accessoires</h4>
                @foreach($accessoires as $accessoire)
                    <div class="card mb-3">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                @if($accessoire->image)
                                    <img src="{{ asset('storage/' . $accessoire->image) }}" class="card-img-top" alt="{{ $accessoire->nom }}">
                                @else
                                    <img src="{{ asset('images/default-accessoire.jpg') }}" class="card-img-top" alt="Image non disponible">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $accessoire->nom }}</h5>
                                    <p class="card-text price">{{ number_format($accessoire->prix, 0, '', ' ') }} TND</p>
                                    <div class="input-group">
                                        <input type="number" name="accessoires[{{ $accessoire->id }}][quantite]" value="0" min="0" class="form-control">
                                        <div class="input-group-append">
                                            <span class="input-group-text">unité(s)</span>
                                        </div>
                                    </div>
                                    <input type="hidden" name="accessoires[{{ $accessoire->id }}][id]" value="{{ $accessoire->id }}">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block mt-4 py-3" style="font-size: 1.1rem;">
            <i class="fas fa-paper-plane mr-2"></i> Passer la commande
        </button>
    </form>
</div>
@endsection