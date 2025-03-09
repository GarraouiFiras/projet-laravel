@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Modifier l'accessoire</h1>

    <form action="{{ route('accessoires.update', $accessoire->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" class="form-control" value="{{ $accessoire->nom }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ $accessoire->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="prix">Prix</label>
            <input type="number" name="prix" id="prix" class="form-control" value="{{ $accessoire->prix }}" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="stock">Stock</label>
            <input type="number" name="stock" id="stock" class="form-control" value="{{ $accessoire->stock }}" required>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" class="form-control">
            @if($accessoire->image)
                <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->nom }}" width="100" class="mt-2">
            @else
                <p>Pas d'image</p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('accessoires.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection