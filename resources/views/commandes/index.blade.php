@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Liste des commandes</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Nom du client</th>
                <th>Total</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commandes as $commande)
                <tr>
                    <td>{{ $commande->id }}</td>
                    <td>{{ $commande->nom_client }}</td>
                    <td>{{ $commande->total }} €</td>
                    <td>{{ $commande->statut }}</td>
                    <td>{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('commandes.show', $commande->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection