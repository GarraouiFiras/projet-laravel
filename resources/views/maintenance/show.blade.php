@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('{{ asset('assets/img/art.jpg') }}');
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

    h1 {
        color: #000;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 20px;
        backdrop-filter: blur(5px);
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #000;
    }

    .card-text {
        margin-bottom: 10px;
        color: #000;
    }

    .btn {
        margin-top: 15px;
        background-color: rgba(52, 152, 219, 0.8);
        color: white;
        border: none;
        transition: all 0.2s ease-in-out;
    }

    .btn:hover {
        background-color: rgba(41, 128, 185, 0.9);
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }
</style>

<div class="content-container">
    <h1 class="text-center">Détails du rendez-vous</h1>

    <div class="card">
        <h5 class="card-title">Client : {{ $maintenance->client_name }}</h5>
        <p class="card-text"><strong>Voiture :</strong> {{ $maintenance->car->name }}</p>
        <p class="card-text"><strong>Date :</strong> {{ $maintenance->date }}</p>
        <p class="card-text"><strong>Heure :</strong> {{ $maintenance->time }}</p>
        <p class="card-text"><strong>Description :</strong> {{ $maintenance->description ?? 'Aucune description' }}</p>
        <a href="{{ route('maintenance.index') }}" class="btn">Retour</a>
    </div>
</div>
@endsection
