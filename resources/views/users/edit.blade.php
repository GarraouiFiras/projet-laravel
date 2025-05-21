@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: rgba(108, 99, 255, 0.8);
            --primary-hover: rgba(76, 68, 210, 0.9);
            --glass-light: rgba(255, 255, 255, 0.15);
            --glass-dark: rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('{{ asset("assets/img/art.jpg") }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .glass-container {
            max-width: 800px;
            margin: 2rem auto;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 16px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }

        .page-title {
            color: #fff;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 2rem;
            font-weight: 700;
            text-align: center;
            letter-spacing: 0.5px;
        }

        .form-label {
            font-weight: 600;
            color: #fff;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .form-control, .form-select {
            background-color: rgba(255, 255, 255, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus, .form-select:focus {
            background-color: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 0 0.25rem rgba(108, 99, 255, 0.25);
            border-color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-light {
            border-color: rgba(255, 255, 255, 0.3);
            color: rgba(255, 255, 255, 0.9);
            transition: all 0.3s ease;
        }

        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        .text-danger {
            color: #ff6b6b !important;
            font-size: 0.85rem;
            margin-top: 0.25rem;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }

        /* Effet de transition pour les éléments du formulaire */
        .form-group {
            transition: transform 0.3s ease;
        }

        .form-group:hover {
            transform: translateX(5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            .row {
                flex-direction: column;
                gap: 1rem;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.75rem;
            }
            
            .btn {
                width: 100%;
            }
        }

        /* Animation subtile */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .glass-container {
            animation: fadeIn 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
<div class="glass-container">
    <h1 class="page-title">Modifier l'utilisateur #{{ $user->id }}</h1>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            <!-- Civilité -->
            <div class="col-md-3 form-group">
                <label for="civilite" class="form-label">Civilité</label>
                <select class="form-select" id="civilite" name="civilite" required>
                    <option value="M." {{ $user->civilite == 'M.' ? 'selected' : '' }}>M.</option>
                    <option value="Mme" {{ $user->civilite == 'Mme' ? 'selected' : '' }}>Mme</option>
                    <option value="Mlle" {{ $user->civilite == 'Mlle' ? 'selected' : '' }}>Mlle</option>
                </select>
                @error('civilite')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nom complet -->
            <div class="col-md-9 form-group">
                <label for="name" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="name" name="name" 
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6 form-group">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" 
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Téléphone -->
            <div class="col-md-6 form-group">
                <label for="telephone" class="form-label">Téléphone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" 
                       value="{{ old('telephone', $user->telephone) }}" 
                       pattern="[0-9]{8}" title="8 chiffres requis" required>
                @error('telephone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Rôle -->
            <div class="col-md-6 form-group">
                <label for="role" class="form-label">Rôle</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrateur</option>
                    <option value="vendeur" {{ old('role', $user->role) == 'vendeur' ? 'selected' : '' }}>Vendeur</option>
                    <option value="technicien" {{ old('role', $user->role) == 'technicien' ? 'selected' : '' }}>Technicien</option>
                    <option value="gestionnaire" {{ old('role', $user->role) == 'gestionnaire' ? 'selected' : '' }}>Gestionnaire</option>
                </select>
                @error('role')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Mot de passe (optionnel) -->
            <div class="col-md-6 form-group">
                <label for="password" class="form-label">Nouveau mot de passe (optionnel)</label>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Laisser vide pour ne pas changer">
                <small class="text-muted">Minimum 8 caractères</small>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="action-buttons">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save me-2"></i>Enregistrer
            </button>
            <a href="{{ route('users.index') }}" class="btn btn-outline-light">
                <i class="fas fa-arrow-left me-2"></i>Retour
            </a>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>

<script>
    // Validation côté client pour le téléphone
    document.getElementById('telephone').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length > 8) {
            this.value = this.value.slice(0, 8);
        }
    });

    // Animation au chargement
    document.addEventListener('DOMContentLoaded', () => {
        const formGroups = document.querySelectorAll('.form-group');
        formGroups.forEach((group, index) => {
            group.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
</body>
</html>
@endsection