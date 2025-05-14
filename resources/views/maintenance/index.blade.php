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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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

    /* Filtres - Tous les éléments en ligne */
    .filter-container {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 25px;
    }

    .filter-form {
        display: flex;
        gap: 15px;
        align-items: flex-end;
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 150px;
    }

    .filter-control {
        width: 100%;
        padding: 8px 12px;
        border-radius: 6px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        background-color: rgba(255, 255, 255, 0.8);
    }

    /* Boutons Filtrer/Réinitialiser alignés */
    .filter-buttons {
        display: flex;
        gap: 10px;
    }

    /* Tableau */
    .table-container {
        background-color: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(5px);
        border-radius: 10px;
        padding: 20px;
        overflow-x: auto;
    }

    h1 {
        color: #2c3e50;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
        text-align: center;
        font-weight: 600;
    }

    /* Tous les boutons d'action en ligne */
    .action-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: nowrap;
    }

    /* Style des boutons */
    .btn {
        padding: 8px 12px;
        border-radius: 6px;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .btn-primary {
        background-color: rgba(52, 152, 219, 0.9);
        color: white;
    }

    .btn-secondary {
        background-color: rgba(108, 117, 125, 0.9);
        color: white;
    }

    .btn-info {
        background-color: rgba(23, 162, 184, 0.9);
        color: white;
    }

    .btn-warning {
        background-color: rgba(255, 193, 7, 0.9);
        color: #212529;
    }

    .btn-danger {
        background-color: rgba(220, 53, 69, 0.9);
        color: white;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        opacity: 0.9;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .filter-form {
            flex-direction: column;
            align-items: stretch;
        }
        
        .filter-group {
            width: 100%;
        }
        
        .filter-buttons {
            justify-content: flex-end;
        }
    }

    @media (max-width: 768px) {
        .action-buttons {
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 6px 10px;
            font-size: 0.875rem;
        }
    }
</style>

<div class="content-container">
    <h1>Gestion des rendez-vous de maintenance</h1>
    
    @if(session('success'))
        <div class="alert alert-success text-center mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Filtres - Tous en ligne -->
    <div class="filter-container">
        <form method="GET" action="{{ route('maintenance.index') }}" class="filter-form">
            <div class="filter-group">
                <label class="form-label">Client</label>
                <input type="text" name="client" class="filter-control" placeholder="Nom du client" value="{{ request('client') }}">
            </div>
            
            <div class="filter-group">
                <label class="form-label">Voiture</label>
                <select name="car_id" class="filter-control">
                    <option value="">Toutes les voitures</option>
                    @foreach($cars as $car)
                        <option value="{{ $car->id }}" {{ request('car_id') == $car->id ? 'selected' : '' }}>{{ $car->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-group">
                <label class="form-label">Date</label>
                <input type="date" name="date" class="filter-control" value="{{ request('date') }}">
            </div>
            
            <div class="filter-group">
                <label class="form-label">Statut</label>
                <select name="status" class="filter-control">
                    <option value="">Tous les statuts</option>
                    @foreach($statuses as $key => $value)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="filter-buttons">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
                <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">
                    <i class="fas fa-sync-alt"></i> Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Voiture</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Statut</th>
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
                        <td>
                            <span class="badge bg-{{ $maintenance->status == 'completed' ? 'success' : ($maintenance->status == 'pending' ? 'warning' : ($maintenance->status == 'canceled' ? 'danger' : 'info')) }}">
                                {{ $statuses[$maintenance->status] ?? $maintenance->status }}
                            </span>
                        </td>
                        <td>{{ $maintenance->description ?? '<span class="text-muted">Aucune description</span>' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('maintenance.show', $maintenance->id) }}" class="btn btn-info btn-sm" title="Voir">
                                    <i class="fas fa-eye"></i> 
                                </a>
                                <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn btn-warning btn-sm" title="Modifier">
                                    <i class="fas fa-edit"></i> 
                                </a>
                                <form action="{{ route('maintenance.destroy', $maintenance->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Supprimer" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rendez-vous ?')">
                                        <i class="fas fa-trash-alt"></i> 
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">Aucun rendez-vous trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if($maintenances->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $maintenances->appends(request()->query())->links() }}
            </div>
        @endif
    </div>
</div>
@endsection