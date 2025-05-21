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

    .form-group label {
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid #ced4da;
        border-radius: 8px;
        padding: 12px 15px;
        transition: all 0.3s;
        width: 100%;
    }

    .form-control:focus {
        border-color: #3490dc;
        box-shadow: 0 0 0 0.2rem rgba(52, 144, 220, 0.25);
        background-color: white;
    }

    .btn-primary {
        background-color: rgba(13, 110, 253, 0.8);
        border: none;
        padding: 12px 30px;
        font-weight: 600;
        border-radius: 50px;
        transition: all 0.3s;
        color: white;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-primary:hover {
        background-color: rgba(11, 94, 215, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .form-row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 15px;
        padding-left: 15px;
    }

    textarea.form-control {
        min-height: 150px;
    }

    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        
        .content-container {
            padding: 20px;
            margin: 20px;
        }
    }

    /* Animation pour le bouton */
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }

    .btn-submit {
        animation: pulse 2s infinite;
    }

    .btn-submit:hover {
        animation: none;
    }
</style>

<div class="content-container">
    <h1>Prendre un rendez-vous de maintenance</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form id="maintenanceForm" action="{{ route('maintenance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

        <div class="form-group">
            <label>Client</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
        </div>

        <div class="form-group">
            <label for="car_id">Voiture concernée</label>
            <select name="car_id" id="car_id" class="form-control" required>
                <option value="">Sélectionnez votre voiture</option>
                @foreach(auth()->user()->commandes()
                    ->with(['commandeItems.car'])
                    ->where('statut', 'livrée')
                    ->get() as $commande)
                    
                    @foreach($commande->commandeItems as $item)
                        @if($item->car)
                            <option value="{{ $item->car->id }}">
                                {{ $item->car->name }} ({{ $item->car->model }})
                            </option>
                        @endif
                    @endforeach
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="appointment_type">Type de rendez-vous</label>
            <select name="appointment_type" id="appointment_type" class="form-control" required>
                <option value="">Sélectionnez le type</option>
                <option value="diagnostic">Diagnostic</option>
                <option value="oil_change">Vidange</option>
                <option value="electrical">Problème électrique</option>
                <option value="mechanical">Problème mécanique</option>
                <option value="tires">Pneus/Alignement</option>
                <option value="brakes">Freinage</option>
                <option value="other">Autre</option>
            </select>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" min="{{ date('Y-m-d') }}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="time">Heure</label>
                <input type="time" name="time" id="time" class="form-control" min="08:00" max="18:00" required>
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description détaillée du problème</label>
            <textarea name="description" id="description" class="form-control" rows="5" placeholder="Décrivez en détail le problème que vous rencontrez..." required></textarea>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary btn-lg btn-submit">
                Confirmer le rendez-vous
            </button>
        </div>
    </form>
</div>


@endsection