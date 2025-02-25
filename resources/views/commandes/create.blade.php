@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Passer une commande</h1>

    <form action="{{ route('commandes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nom_client">Votre nom</label>
            <input type="text" name="nom_client" id="nom_client" class="form-control" required>
        </div>

        <h4>Accessoires</h4>
        @foreach($accessoires as $accessoire)
            <div class="form-group">
                <label>{{ $accessoire->nom }} ({{ $accessoire->prix }} €)</label>
                <input type="number" name="accessoires[{{ $accessoire->id }}][quantite]" value="0" min="0" class="form-control">
                <input type="hidden" name="accessoires[{{ $accessoire->id }}][id]" value="{{ $accessoire->id }}">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Passer la commande</button>
    </form>
</div>
@endsection