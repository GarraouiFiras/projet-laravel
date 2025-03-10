@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center my-4">Rendez-vous de maintenance</h1>
    

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Client</th>
                <th>Voiture</th>
                <th>Date</th>
                <th>Heure</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($maintenances as $maintenance)
                <tr>
                    <td>{{ $maintenance->client_name }}</td>
                    <td>{{ $maintenance->car->name }}</td>
                    <td>{{ $maintenance->date }}</td>
                    <td>{{ $maintenance->time }}</td>
                    <td>{{ $maintenance->description ?? 'Aucune description' }}</td>
                    <td>
                        <a href="{{ route('maintenance.show', $maintenance->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Aucun rendez-vous de maintenance trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: #fff;
    }
    .table th, .table td {
        padding: 12px;
        vertical-align: middle;
    }
    .table thead th {
        background-color: #343a40;
        color: #fff;
    }
    .btn {
        margin-right: 5px;
    }
    .alert {
        margin-bottom: 20px;
    }
</style>
@endsection