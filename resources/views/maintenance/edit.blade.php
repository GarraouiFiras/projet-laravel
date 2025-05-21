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
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 30px;
        margin: 30px auto;
        width: 95%;
        max-width: 800px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    h1 {
        color: #2c3e50;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
        margin-bottom: 25px;
        text-align: center;
        font-weight: 600;
    }

    .form-label {
        font-weight: 500;
        color: #2c3e50;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 10px 15px;
        width: 100%;
        margin-bottom: 20px;
        transition: all 0.3s;
        backdrop-filter: blur(2px);
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.95);
        box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        outline: none;
        border-color: #3498db;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        margin-right: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: rgba(52, 152, 219, 0.8);
        color: white;
    }

    .btn-primary:hover {
        background-color: rgba(41, 128, 185, 0.9);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
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

    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-left: 10px;
    }

    .status-pending {
        background-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .status-confirmed {
        background-color: rgba(13, 110, 253, 0.2);
        color: #0d6efd;
    }

    .status-completed {
        background-color: rgba(40, 167, 69, 0.2);
        color: #28a745;
    }

    .status-canceled {
        background-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    @media (max-width: 768px) {
        .content-container {
            padding: 20px;
            margin: 20px auto;
        }
        
        .btn {
            width: 100%;
            margin-bottom: 10px;
            margin-right: 0;
        }
    }
</style>

<div class="content-container">
    <h1>Modifier le rendez-vous 
        <span class="status-badge status-{{ $maintenance->status }}">
            {{ $statuses[$maintenance->status] ?? $maintenance->status }}
        </span>
    </h1>
    
    @if ($errors->any())
        <div class="alert alert-danger" style="background-color: rgba(220, 53, 69, 0.2); color: #dc3545; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid rgba(220, 53, 69, 0.3);">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <form action="{{ route('maintenance.update', $maintenance->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="status" class="form-control">
                @foreach($statuses as $key => $value)
                    <option value="{{ $key }}" {{ $maintenance->status == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $maintenance->date }}">
        </div>
        
        <div class="mb-3">
            <label class="form-label">Heure</label>
            <input type="time" name="time" class="form-control" value="{{ $maintenance->time }}">
        </div>
        <div class="mb-3">
    <label class="form-label">Type de rendez-vous</label>
    <select name="appointment_type" class="form-control" required>
        <option value="">Sélectionnez le type</option>
        <option value="diagnostic" {{ $maintenance->appointment_type == 'diagnostic' ? 'selected' : '' }}>Diagnostic</option>
        <option value="oil_change" {{ $maintenance->appointment_type == 'oil_change' ? 'selected' : '' }}>Vidange</option>
        <option value="electrical" {{ $maintenance->appointment_type == 'electrical' ? 'selected' : '' }}>Problème électrique</option>
        <option value="mechanical" {{ $maintenance->appointment_type == 'mechanical' ? 'selected' : '' }}>Problème mécanique</option>
        <option value="tires" {{ $maintenance->appointment_type == 'tires' ? 'selected' : '' }}>Pneus/Alignement</option>
        <option value="brakes" {{ $maintenance->appointment_type == 'brakes' ? 'selected' : '' }}>Freinage</option>
        <option value="other" {{ $maintenance->appointment_type == 'other' ? 'selected' : '' }}>Autre</option>
    </select>
</div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $maintenance->description }}</textarea>
        </div>
        
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Enregistrer
            </button>
            <a href="{{ route('maintenance.index') }}" class="btn btn-secondary">
                <i class="fas fa-times me-2"></i>Annuler
            </a>
        </div>
    </form>
</div>
@endsection