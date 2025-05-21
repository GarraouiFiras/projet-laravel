@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-image: url('assets/img/art.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            color: #000;
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

        .table-container {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 20px;
            backdrop-filter: blur(5px);
            overflow-x: auto;
        }

        .table {
            background-color: transparent;
            color: #000;
            margin-bottom: 0;
        }

        .table th {
            background-color: rgba(0, 0, 0, 0.1);
            color: #000;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            font-weight: 600;
            vertical-align: middle;
        }

        .table td {
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.3);
            vertical-align: middle;
        }

        .table-hover tbody tr:hover td {
            background-color: rgba(255, 255, 255, 0.5);
        }

        h1 {
            color: #000;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
            margin-bottom: 25px;
            font-weight: 700;
        }

        .alert {
            backdrop-filter: blur(5px);
            background-color: rgba(255, 255, 255, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .btn-action {
            margin: 2px;
            min-width: 80px;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background-color: rgba(52, 152, 219, 0.8);
        }

        .btn-primary:hover {
            background-color: rgba(41, 128, 185, 0.9);
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: rgba(231, 76, 60, 0.8);
        }

        .btn-danger:hover {
            background-color: rgba(203, 67, 53, 0.9);
            transform: translateY(-2px);
        }

        .action-buttons {
            display: flex;
            gap: 5px;
            flex-wrap: nowrap;
        }

       .badge {
    font-weight: 500;
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 0.85rem;
}

.bg-danger { background-color: rgba(231, 76, 60, 0.9); }
.bg-primary { background-color: rgba(52, 152, 219, 0.9); }
.bg-warning { background-color: rgba(241, 196, 15, 0.9); }
.bg-success { background-color: rgba(46, 204, 113, 0.9); }
.bg-secondary { background-color: rgba(149, 165, 166, 0.9); }
.text-dark { color: #343a40 !important; }
        @media (max-width: 768px) {
            .content-container {
                padding: 15px;
            }
            
            .table-container {
                padding: 10px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .btn-action {
                min-width: 60px;
                padding: 0.25rem 0.5rem;
            }
        }
    </style>
</head>
<body>
<div class="content-container">
    <h1 class="text-center">Gestion des utilisateurs</h1>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show text-center">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="table-container">
        <table class="table table-hover">
            <thead>
                <tr>
                    
                    <th>Civilité</th>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Rôle</th>
                    <th>Date d'inscription</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                   
                    <td>{{ $user->civilite }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->telephone }}</td>
                    <td>
                        @switch($user->role)
                        @case('admin')
                        <span class="badge bg-danger">Admin</span>
                         @break
                         @case('vendeur')
                         <span class="badge bg-primary">Vendeur</span>
                          @break
                         @case('technicien')
                         <span class="badge bg-warning text-dark">Technicien</span>
                         @break
                           @case('gestionnaire')
                          <span class="badge bg-success">Gestionnaire</span>
                                  @break
                           @default
                             <span class="badge bg-secondary">Utilisateur</span>
                            @endswitch
                    </td>
                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm btn-action">
                                <i class="fas fa-edit"></i> Modifier
                            </a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm btn-action">
                                    <i class="fas fa-trash-alt"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
@endsection