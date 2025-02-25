@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Liste des accessoires</h1>
    <a href="{{ route('accessoires.create') }}" class="btn btn-primary mb-3">Ajouter un accessoire</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($accessoires as $accessoire)
                <tr>
                    <td>
                        @if($accessoire->image)
                            <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->nom }}" width="100">
                        @else
                            Pas d'image
                        @endif
                    </td>
                    <td>{{ $accessoire->nom }}</td>
                    <td>{{ $accessoire->description }}</td>
                    <td>{{ $accessoire->prix }} €</td>
                    <td>{{ $accessoire->stock }}</td>
                    <td>
                        <a href="{{ route('accessoires.show', $accessoire->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('accessoires.edit', $accessoire->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('accessoires.destroy', $accessoire->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet accessoire ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection