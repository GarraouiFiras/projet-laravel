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
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        text-align: center;
        font-weight: 600;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        padding: 25px;
        backdrop-filter: blur(5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .card-title {
        font-size: 1.5rem;
        margin-bottom: 20px;
        color: #2c3e50;
        text-align: center;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        padding-bottom: 10px;
    }

    .card-text {
        margin-bottom: 15px;
        color: #2c3e50;
        display: flex;
        align-items: flex-start;
    }

    .card-text strong {
        min-width: 150px;
        display: inline-block;
        color: #3490dc;
    }

    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: capitalize;
    }

    .badge-type {
        background-color: #6f42c1;
        color: white;
    }

    .badge-status {
        background-color: #38c172;
        color: white;
    }

    .badge-pending { background-color: #ffc107; color: #212529; }
    .badge-confirmed { background-color: #17a2b8; color: white; }
    .badge-completed { background-color: #28a745; color: white; }
    .badge-canceled { background-color: #dc3545; color: white; }

    .btn {
        margin-top: 20px;
        background-color: rgba(52, 152, 219, 0.8);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn:hover {
        background-color: rgba(41, 128, 185, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        text-decoration: none;
    }

    .btn i {
        margin-right: 8px;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 15px;
        margin-bottom: 20px;
    }

    @media (max-width: 768px) {
        .content-container {
            padding: 20px;
        }
        
        .card-text {
            flex-direction: column;
        }
        
        .card-text strong {
            margin-bottom: 5px;
        }
    }
</style>

<div class="content-container">
    <h1>Détails du rendez-vous</h1>

    <div class="card">
        <h5 class="card-title">Rendez-vous #{{ $maintenance->id }}</h5>
        
        <div class="info-grid">
            <div>
                <p class="card-text">
                    <strong>Client :</strong> 
                    <span>{{ $maintenance->user->name ?? 'Ancien client' }}</span>
                </p>
                
                <p class="card-text">
                    <strong>Email :</strong> 
                    <span>{{ $maintenance->user->email ?? 'Non disponible' }}</span>
                </p>
                
                <p class="card-text">
                    <strong>Téléphone :</strong> 
                    <span>{{ $maintenance->user->telephone ?? 'Non disponible' }}</span>
                </p>
            </div>
            
            <div>
                <p class="card-text">
                    <strong>Voiture :</strong> 
                    <span>{{ $maintenance->car->name }} ({{ $maintenance->car->model }})</span>
                </p>
                
                <p class="card-text">
                    <strong>Année :</strong> 
                    <span>{{ $maintenance->car->year ?? 'Non disponible' }}</span>
                </p>
            </div>
        </div>
        
        <div class="info-grid">
            <div>
                <p class="card-text">
                    <strong>Date :</strong> 
                    <span>{{ \Carbon\Carbon::parse($maintenance->date)->format('d/m/Y') }}</span>
                </p>
                
                <p class="card-text">
                    <strong>Heure :</strong> 
                    <span>{{ $maintenance->time }}</span>
                </p>
                
                <p class="card-text">
                    <strong>Durée estimée :</strong> 
                    <span>{{ $maintenance->duration ?? '1 heure' }}</span>
                </p>
            </div>
            
            <div>
                <p class="card-text">
                    <strong>Type :</strong> 
                    <span class="badge badge-type">
                        @switch($maintenance->appointment_type)
                            @case('diagnostic') Diagnostic @break
                            @case('oil_change') Vidange @break
                            @case('electrical') Problème électrique @break
                            @case('mechanical') Problème mécanique @break
                            @case('tires') Pneus/Alignement @break
                            @case('brakes') Freinage @break
                            @default Autre
                        @endswitch
                    </span>
                </p>
                
                <p class="card-text">
                    <strong>Statut :</strong> 
                    <span class="badge badge-status badge-{{ $maintenance->status }}">
                        {{ $statuses[$maintenance->status] ?? $maintenance->status }}
                    </span>
                </p>
                
                <p class="card-text">
                    <strong>Créé le :</strong> 
                    <span>{{ $maintenance->created_at->format('d/m/Y H:i') }}</span>
                </p>
            </div>
        </div>
        
        <div>
            <p class="card-text">
                <strong>Description :</strong> 
            </p>
            <div style="background-color: rgba(255,255,255,0.7); padding: 15px; border-radius: 8px; margin-top: 5px;">
                {{ $maintenance->description ?? 'Aucune description fournie' }}
            </div>
        </div>
        
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ route('maintenance.index') }}" class="btn">
                <i class="fas fa-arrow-left"></i> Retour à la liste
            </a>
            
            @can('update', $maintenance)
                <a href="{{ route('maintenance.edit', $maintenance->id) }}" class="btn" style="background-color: rgba(255, 193, 7, 0.8);">
                    <i class="fas fa-edit"></i> Modifier
                </a>
            @endcan
        </div>
    </div>
</div>
@endsection