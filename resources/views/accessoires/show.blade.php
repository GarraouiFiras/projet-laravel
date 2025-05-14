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
        max-width: 800px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-details {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border: none;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        color: #000;
    }

    h1 {
        color: #000;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
    }

    .card-title {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
        color: #000;
    }

    .card-text {
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .card-text strong {
        font-weight: 600;
    }

    img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background-color: rgba(108, 117, 125, 0.8);
        border: none;
        padding: 8px 20px;
        margin-top: 20px;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: rgba(84, 91, 98, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="content-container">
    <h1 class="text-center">Détails de l'accessoire</h1>
    <div class="card card-details">
        <div class="card-body">
            <h5 class="card-title">{{ $accessoire->nom }}</h5>
            <p class="card-text"><strong>Description :</strong> {{ $accessoire->description }}</p>
            <p class="card-text"><strong>Prix :</strong> {{ $accessoire->prix }} €</p>
            <p class="card-text"><strong>Stock :</strong> {{ $accessoire->stock }}</p>
            @if($accessoire->image)
                <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->nom }}" class="img-fluid" style="max-height: 300px;">
            @else
                <p class="text-muted">Pas d'image disponible</p>
            @endif
            <div class="text-center">
                <a href="{{ route('accessoires.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection