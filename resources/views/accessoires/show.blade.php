@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Détails de l'accessoire</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $accessoire->nom }}</h5>
            <p class="card-text"><strong>Description :</strong> {{ $accessoire->description }}</p>
            <p class="card-text"><strong>Prix :</strong> {{ $accessoire->prix }} €</p>
            <p class="card-text"><strong>Stock :</strong> {{ $accessoire->stock }}</p>
            @if($accessoire->image)
                <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->nom }}" width="200">
            @else
                <p>Pas d'image</p>
            @endif
            <a href="{{ route('accessoires.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection