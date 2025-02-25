@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Détails du rendez-vous</h1>

    <div class="card">
        <div class="card-body">
        <h5 class="card-title">Client : {{ $maintenance->client_name }}</h5> 
            <p class="card-text"><strong>Voiture :</strong> {{ $maintenance->car->name }}</p>
            <p class="card-text"><strong>Date :</strong> {{ $maintenance->date }}</p>
            <p class="card-text"><strong>Heure :</strong> {{ $maintenance->time }}</p>
            <p class="card-text"><strong>Description :</strong> {{ $maintenance->description ?? 'Aucune description' }}</p>
            <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }
    .card {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .card-body {
        padding: 20px;
    }
    .card-title {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }
    .card-text {
        margin-bottom: 10px;
    }
    .btn {
        margin-top: 15px;
    }
</style>
@endsection