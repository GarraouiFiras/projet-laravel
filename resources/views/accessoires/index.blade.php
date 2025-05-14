@extends('layouts.app')

@section('content')
<style>
    body {
        background-image: url('assets/img/art.jpg');
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
        max-width: 1200px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .filter-container {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
    }

    /* Modification principale ici */
    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 150px;
    }

    .filter-buttons {
        display: flex;
        gap: 10px;
        margin-left: auto;
    }

    .table-container {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 20px;
        backdrop-filter: blur(5px);
    }

    .table {
        background-color: transparent;
        color: #000;
    }

    .table th {
        background-color: rgba(0, 0, 0, 0.1);
        color: #000;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .table td {
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.3);
        vertical-align: middle;
    }

    h1 {
        color: #000;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(0, 0, 0, 0.1);
        width: 100%;
        padding: 8px 12px;
        border-radius: 6px;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
    }

    .btn-filter {
        background-color: rgba(52, 152, 219, 0.8);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
    }

    .btn-filter:hover {
        background-color: rgba(41, 128, 185, 0.9);
        transform: translateY(-1px);
    }

    .btn-reset {
        background-color: rgba(108, 117, 125, 0.8);
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
    }

    .btn-reset:hover {
        background-color: rgba(84, 91, 98, 0.9);
        transform: translateY(-1px);
    }

    /* Styles pour les boutons d'action - inchangés */
    .action-buttons {
        display: flex;
        flex-wrap: nowrap;
        gap: 5px;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
        white-space: nowrap;
    }

    .btn-info {
        background-color: rgba(23, 162, 184, 0.8);
        color: white;
    }

    .btn-warning {
        background-color: rgba(255, 193, 7, 0.8);
        color: #000;
    }

    .btn-danger {
        background-color: rgba(220, 53, 69, 0.8);
        color: white;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    @media (max-width: 992px) {
        .filter-form {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .filter-buttons {
            margin-left: 0;
            justify-content: flex-end;
        }
    }
</style>

<div class="content-container">
    <h1 class="text-center">Liste des accessoires</h1>
    
    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtres modifiés -->
    <div class="filter-container">
        <form method="GET" action="{{ route('accessoires.index') }}" class="filter-form">
            <div class="filter-group">
                <label class="form-label">Nom</label>
                <input type="text" class="form-control" name="nom" value="{{ request('nom') }}" placeholder="Filtrer par nom">
            </div>
            
            <div class="filter-group">
                <label class="form-label">Prix min</label>
                <input type="number" class="form-control" name="prix_min" value="{{ request('prix_min') }}" placeholder="Prix minimum" step="0.01">
            </div>
            
            <div class="filter-group">
                <label class="form-label">Prix max</label>
                <input type="number" class="form-control" name="prix_max" value="{{ request('prix_max') }}" placeholder="Prix maximum" step="0.01">
            </div>
            
            <div class="filter-group">
                <label class="form-label">Stock min</label>
                <input type="number" class="form-control" name="stock_min" value="{{ request('stock_min') }}" placeholder="Stock minimum">
            </div>
            
            <div class="filter-buttons">
                <button type="submit" class="btn btn-filter">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('accessoires.index') }}" class="btn btn-reset">
                    <i class="fas fa-times"></i> Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <!-- Le reste du code reste inchangé -->
    <div class="table-container">
        <table class="table table-hover">
            <thead>
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
                                <img src="{{ asset('storage/' . $accessoire->image) }}" alt="{{ $accessoire->nom }}" width="80" class="img-thumbnail">
                            @else
                                <span>Pas d'image</span>
                            @endif
                        </td>
                        <td>{{ $accessoire->nom }}</td>
                        <td>{{ $accessoire->description }}</td>
                        <td>{{ number_format($accessoire->prix, 0, '', ' ') }} TND</td>
                        <td>{{ $accessoire->stock }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('accessoires.show', $accessoire->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(Auth::check() && (Auth::user()->role === 'gestionnaire' || Auth::user()->role === 'admin'))
                                    <a href="{{ route('accessoires.edit', $accessoire->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('accessoires.destroy', $accessoire->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet accessoire ?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {!! $accessoires->appends(\Request::except('page'))->render() !!}
        </div>
    </div>
</div>
@endsection