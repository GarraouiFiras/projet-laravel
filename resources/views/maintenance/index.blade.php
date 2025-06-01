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

    /* Badge pour les types de rendez-vous */
    .badge-type {
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    .badge-diagnostic { background-color: #6f42c1; color: white; }
    .badge-oil_change { background-color: #fd7e14; color: white; }
    .badge-electrical { background-color: #20c997; color: white; }
    .badge-mechanical { background-color: #17a2b8; color: white; }
    .badge-tires { background-color: #ffc107; color: #212529; }
    .badge-brakes { background-color: #dc3545; color: white; }
    .badge-other { background-color: #6c757d; color: white; }

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

    <!-- Filtres -->
    <div class="filter-container">
        <form method="GET" action="{{ route('maintenance.index') }}" class="filter-form" id="filter-form">
            <!-- [Vos champs de filtre existants] -->
        </form>
    </div>

    <!-- Conteneur du tableau (seulement cette partie) -->
    <div class="table-container" id="maintenance-content">
        @include('maintenance.partial', [
            'maintenances' => $maintenances, 
            'cars' => $cars, 
            'statuses' => $statuses
        ])
    </div>
</div>

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion du chargement AJAX
    window.addEventListener('content-load', function(e) {
        fetch(e.detail.url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('maintenance-content').innerHTML = data.content;
                // Réappliquer le style de fond si nécessaire
                document.body.style.backgroundImage = "url('/assets/img/art.jpg')";
                document.body.style.backgroundSize = "cover";
                document.body.style.backgroundAttachment = "fixed";
            }
        });
    });

    // Gestion des filtres
    document.getElementById('filter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const url = new URL(this.action);
        const params = new URLSearchParams(formData);
        
        fetch(`${url.pathname}?${params}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('maintenance-content').innerHTML = data.content;
                history.pushState({}, '', `${url.pathname}?${params}`);
            }
        });
    });

    // Réinitialiser les événements après chargement AJAX
    function initDynamicContentEvents() {
        document.querySelectorAll('.load-content').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                window.dispatchEvent(new CustomEvent('content-load', { 
                    detail: { url: this.getAttribute('data-url') }
                }));
            });
        });
    }
    initDynamicContentEvents();
});
</script>
@endsection
@endsection