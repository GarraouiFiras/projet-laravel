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
        padding: 15px;
        margin: 20px auto;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-details {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border: none;
        border-radius: 8px;
        padding: 15px;
    }

    h1 {
        color: #000;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 15px;
        font-size: 1.5rem;
    }

    .card-title {
        font-size: 1.3rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #000;
    }

    .card-text {
        font-size: 1rem;
        margin-bottom: 0.8rem;
    }

    .card-text strong {
        font-weight: 600;
    }

    .price-highlight {
        font-size: 1.2rem;
        font-weight: bold;
    }

    img {
        max-width: 100%;
        height: auto;
        max-height: 200px;
        border-radius: 6px;
        margin: 10px 0;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }

    .btn-secondary {
        background-color: rgba(108, 117, 125, 0.8);
        border: none;
        padding: 6px 15px;
        margin-top: 15px;
        font-size: 0.9rem;
    }

    .text-muted {
        color: #6c757d;
        font-size: 0.9rem;
    }
</style>

<div class="content-container">
    <h1 class="text-center">Détails de l'accessoire</h1>
    <div class="card card-details">
        <div class="card-body">
            <h5 class="card-title">{{ $accessoire->nom }}</h5>
            <p class="card-text"><strong>Description :</strong> {{ $accessoire->description }}</p>
            <p class="card-text"><strong>Prix :</strong> <span class="price-highlight">{{ number_format($accessoire->prix, 0, '', ' ') }} TND</span></p>
            <p class="card-text"><strong>Stock :</strong> {{ $accessoire->stock }}</p>
            
            @if($accessoire->image)
                <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->nom }}" class="img-fluid">
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