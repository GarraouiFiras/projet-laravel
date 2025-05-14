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
    }

    .edit-container {
        background-color: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(8px);
        border-radius: 15px;
        padding: 30px;
        margin: 30px auto;
        width: 95%;
        max-width: 600px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    h1 {
        color: #2c3e50;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 500;
        color: #2c3e50;
    }

    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        background-color: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 0.375rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.9);
        border-color: rgba(52, 152, 219, 0.5);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        outline: none;
    }

    .btn {
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.3s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border: none;
    }

    .btn-secondary {
        background-color: rgba(108, 117, 125, 0.8);
        color: white;
    }

    .btn-secondary:hover {
        background-color: rgba(84, 91, 98, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-primary {
        background-color: rgba(13, 110, 253, 0.8);
        color: white;
    }

    .btn-primary:hover {
        background-color: rgba(11, 94, 215, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    .info-box {
        background-color: rgba(255, 255, 255, 0.3);
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .info-label {
        font-weight: 500;
        color: #2c3e50;
    }

    .info-value {
        font-weight: 600;
    }
</style>

<div class="edit-container">
    <h1 class="text-center mb-4">Modifier la commande #{{ $commande->id }}</h1>

    <div class="info-box">
        <div class="info-item">
            <span class="info-label">Client:</span>
            <span class="info-value">{{ $commande->nom_client }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Total:</span>
            <span class="info-value">{{ number_format($commande->total, 0, '', ' ') }} TND</span>
        </div>
        <div class="info-item">
            <span class="info-label">Date:</span>
            <span class="info-value">{{ $commande->created_at->format('d/m/Y H:i') }}</span>
        </div>
    </div>

    <form action="{{ route('commandes.update', $commande->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-4">
            <label for="statut">Statut de la commande</label>
            <select name="statut" id="statut" class="form-control" required>
                @foreach($statuts as $value => $label)
                    <option value="{{ $value }}" {{ $commande->statut === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ route('commandes.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Retour
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-1"></i> Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection