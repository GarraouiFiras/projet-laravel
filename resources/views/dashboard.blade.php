<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Professionnel | GF Showroom</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    :root {
      --primary-color: #2c3e50;
      --secondary-color: #34495e;
      --accent-color: #3498db;
      --light-color: #ecf0f1;
      --dark-color: #2c3e50;
      --success-color: #2ecc71;
      --warning-color: #f39c12;
      --danger-color: #e74c3c;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('assets/img/art.jpg') no-repeat center center fixed;
      background-size: cover;
      color: #333;
      min-height: 100vh;
    }
    
    /* Overlay sombre pour améliorer la lisibilité */
    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: -1;
    }
    
    .sidebar {
      background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
      height: 100vh;
      position: fixed;
      width: 280px;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
      box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      z-index: 1000;
    }
    
    .sidebar:hover {
      box-shadow: 5px 0 25px rgba(0, 0, 0, 0.2);
    }
    
    .sidebar a {
      color: var(--light-color);
      padding: 15px 25px;
      display: flex;
      align-items: center;
      text-decoration: none;
      font-size: 16px;
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
    }
    
    .sidebar a i {
      margin-right: 12px;
      width: 20px;
      text-align: center;
    }
    
    .sidebar a:hover {
      background-color: rgba(255, 255, 255, 0.1);
      border-left: 3px solid var(--accent-color);
      transform: translateX(5px);
    }
    
    .sidebar .logo-container {
      text-align: center;
      padding: 20px 0;
      background-color: rgba(0, 0, 0, 0.2);
      margin-bottom: 20px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .sidebar .logo {
      width: 180px;
      height: auto;
      transition: all 0.3s ease;
    }
    
    .sidebar .logo:hover {
      transform: scale(1.05);
    }
    
    .content {
      margin-left: 280px;
      padding: 30px;
      position: relative;
    }
    
    .card {
      border-radius: 12px;
      border: none;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
      transition: all 0.3s ease;
      background-color: rgba(255, 255, 255, 0.95);
      overflow: hidden;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.2);
    }
    
    .card-header {
      background: linear-gradient(135deg, var(--accent-color), #2980b9);
      color: white;
      font-weight: 600;
      border-bottom: none;
      padding: 20px;
    }
    
    .navbar {
      background-color: rgba(255, 255, 255, 0.95) !important;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      padding: 15px 25px;
      margin-bottom: 30px;
    }
    
    .logout-btn {
      background: linear-gradient(135deg, var(--danger-color), #c0392b);
      color: white;
      border: none;
      padding: 8px 20px;
      border-radius: 8px;
      font-weight: 500;
      transition: all 0.3s ease;
    }
    
    .logout-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(231, 76, 60, 0.4);
    }
    
    .welcome-message {
      background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(236, 240, 241, 0.95));
      border-radius: 12px;
      padding: 25px;
      margin-bottom: 30px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
      border-left: 5px solid var(--accent-color);
    }
    
    .stat-card {
      text-align: center;
      padding: 25px;
      position: relative;
    }
    
    .stat-card i {
      font-size: 2.5rem;
      margin-bottom: 15px;
      background: linear-gradient(135deg, var(--accent-color), #2980b9);
      -webkit-background-clip: text;
      background-clip: text;
      color: transparent;
    }
    
    .stat-card h5 {
      font-weight: 600;
      margin-bottom: 10px;
    }
    
    .stat-card p {
      font-size: 1.5rem;
      font-weight: 700;
      margin-bottom: 0;
    }
    
    .user-avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--accent-color), #2980b9);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: bold;
      margin: 0 auto 15px;
    }
    
    @media (max-width: 992px) {
      .sidebar {
        width: 80px;
        overflow: hidden;
      }
      
      .sidebar .logo-container {
        padding: 15px 0;
      }
      
      .sidebar .logo {
        width: 50px;
      }
      
      .sidebar a span {
        display: none;
      }
      
      .sidebar a i {
        margin-right: 0;
        font-size: 1.2rem;
      }
      
      .content {
        margin-left: 80px;
      }
      .filter-container .row {
    margin-bottom: 15px;
}

.filter-container .form-label {
    font-weight: 500;
    margin-bottom: 5px;
}

.filter-container .form-control {
    background-color: white;
    border: 1px solid #dee2e6;
}

.filter-container .btn {
    margin-bottom: 5px;
}
    }
    
  </style>
</head>
<body>
 <!-- Sidebar -->
<div class="sidebar bg-dark text-white" style="width: 280px; position: fixed; height: 100vh;">
    <div class="logo-container text-center p-3 border-bottom">
        <img src="{{ asset('assets/img/logoo.png') }}" alt="Logo GF" style="width: 180px;">
    </div>
    
    <nav class="nav flex-column p-3">
        @auth
            <!-- Liens communs à tous les utilisateurs -->
            <a href="{{ url('/') }}" class="nav-link text-white py-3">
                <i class="fas fa-home me-2"></i> Accueil
            </a>
            
            <!-- Section Admin -->
            @if(auth()->user()->role === 'admin')
                <!-- Tableau de bord -->
                <a href="#" class="nav-link text-white py-3"
   onclick="event.preventDefault(); 
            fetch('{{ route('statistics') }}')
              .then(response => response.text())
              .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const content = doc.querySelector('.content').innerHTML;
                document.getElementById('dynamic-content').innerHTML = content;
                initializeCharts();
              });">
    <i class="fas fa-tachometer-alt me-2"></i> Statistiques
</a>



                
                
                <!-- Bouton Ajouter une Voiture -->
                <a href="#" class="nav-link text-white py-3"
                   onclick="event.preventDefault(); 
                            fetch('{{ route('formulaire') }}')
                              .then(response => response.text())
                              .then(html => {
                                document.getElementById('dynamic-content').innerHTML = html;
                              });">
                    <i class="fas fa-car me-2"></i> Ajouter une Voiture
                </a>
                
                <!-- Bouton Gestion Utilisateurs -->
                <a href="#" class="nav-link text-white py-3"
                   onclick="event.preventDefault(); 
                            fetch('/users')
                              .then(response => response.text())
                              .then(html => {
                                document.getElementById('dynamic-content').innerHTML = html;
                              });">
                    <i class="fas fa-users me-2"></i> Gestion Utilisateurs
                </a>
                
                <!-- Bouton Accessoires -->
                <a href="#" class="nav-link text-white py-3 load-content" data-url="{{ route('accessoires.index') }}">
                    <i class="fas fa-tools me-2"></i> Accessoires
                </a>
                
                
                <a href="#" class="nav-link text-white py-3 load-content" data-url="{{ route('commandes.index') }}">
                    <i class="fas fa-shopping-cart me-2"></i> Commandes
                </a>
            @endif
            
            <!-- Liens pour les clients -->
            @if(auth()->user()->role === 'user')
                <a href="{{ route('clients.dashboard') }}" 
                   class="nav-link text-white py-3 load-content" 
                   data-url="{{ route('clients.dashboard') }}"
                   onclick="event.preventDefault(); loadClientContent(this.getAttribute('data-url'));">
                    <i class="fas fa-user me-2"></i> Mon Compte
                </a>
                <div class="client-actions">
                    <a href="#" class="client-btn btn-commande"
                       onclick="event.preventDefault(); 
                                fetch('{{ route('commandes.create') }}')
                                  .then(response => response.text())
                                  .then(html => {
                                    document.getElementById('dynamic-content').innerHTML = html;
                                  });">
                        <i class="fas fa-plus-circle"></i> Nouvelle Commande
                    </a>
                    <a href="#" class="client-btn btn-rdv"
                       onclick="event.preventDefault(); 
                                fetch('{{ route('maintenance.create') }}')
                                  .then(response => response.text())
                                  .then(html => {
                                    document.getElementById('dynamic-content').innerHTML = html;
                                  });">
                        <i class="fas fa-calendar-plus"></i> Nouveau Rendez-vous
                    </a>
                </div>
            @endif
            
            <!-- Liens pour les vendeurs (sans le doublon admin) -->
            @if(auth()->user()->role === 'vendeur' && auth()->user()->role !== 'admin')
                <a href="#" class="nav-link text-white py-3 load-content" data-url="{{ route('commandes.index') }}">
                    <i class="fas fa-shopping-cart me-2"></i> Commandes
                </a>
            @endif
            
            <!-- Liens pour les techniciens -->
            @if(auth()->user()->role === 'technicien' || auth()->user()->role === 'admin')
                <a href="#" class="nav-link text-white py-3 load-content" 
                   data-url="{{ route('maintenance.index') }}"
                   onclick="loadMaintenanceContent('{{ route('maintenance.index') }}')">
                    <i class="fas fa-calendar-check me-2"></i> Rendez-vous
                </a>
            @endif
            
            <!-- Déconnexion -->
            <a href="{{ route('logout') }}" class="nav-link text-white py-3 mt-auto"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
            </a>
        @endauth
    </nav>
</div>


  <!-- Content -->
<div class="content" style="margin-left: 280px; width: calc(100% - 280px);">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <h1 class="navbar-brand mb-0 h4 fw-bold text-primary">Dashboard GF Showroom</h1>
            <div class="d-flex align-items-center">
                <span class="me-3 d-none d-md-inline text-muted">Bienvenue, {{ Auth::user()->name }}</span>
                <button class="btn logout-btn" onclick="document.getElementById('logout-form').submit()">
                    <i class="fas fa-sign-out-alt me-1"></i> Déconnexion
                </button>
            </div>
        </div>
    </nav>

    <!-- Contenu dynamique -->
<div class="container-fluid py-4" id="dynamic-content">
    @if(isset($showClientDashboard) && $showClientDashboard)
        <!-- Contenu du dashboard client -->
        <div class="welcome-message">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-3">Bonjour, {{ $user->name }}!</h2>
                    <p class="lead mb-0">Bienvenue dans votre espace client GF Showroom.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="user-avatar">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Colonne Commandes -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-shopping-cart me-2"></i>Mes Commandes</h5>
                    </div>
                    <div class="card-body">
                        @if($commandes->isEmpty())
                            <p class="mb-0">Aucune commande trouvée</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Date</th>
                                            <th>Statut</th>
                                            <th>Total</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($commandes as $commande)
                                        <tr>
                                            <td>#{{ $commande->id }}</td>
                                            <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <span class="badge" style="background-color: {{ $statutColors[$commande->statut] ?? '#6c757d' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($commande->total, 2) }} TND</td>
                                            <td>
                                                <a href="{{ route('commandes.show', $commande->id) }}" 
                                                   class="btn btn-sm btn-info load-content"
                                                   data-url="{{ route('commandes.show', $commande->id) }}">
                                                   <i class="fas fa-eye"></i>
                                                </a>
                                                @if(in_array($commande->statut, ['en_attente', 'pending']))
                                                <form action="{{ route('commandes.destroy', $commande->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            onclick="return confirm('Supprimer cette commande ?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $commandes->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Colonne Rendez-vous -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-calendar-alt me-2"></i>Mes Rendez-vous</h5>
                    </div>
                    <div class="card-body">
                        @if($rendezvous->isEmpty())
                            <p class="mb-0">Aucun rendez-vous programmé</p>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Heure</th>
                                            <th>Véhicule</th>
                                            <th>Statut</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rendezvous as $rdv)
                                        <tr>
                                            <td>{{ $rdv->date ? \Carbon\Carbon::parse($rdv->date)->format('d/m/Y') : 'N/A' }}</td>
                                <td>{{ $rdv->time ? \Carbon\Carbon::parse($rdv->time)->format('H:i') : 'N/A' }}</td>
                                            <td>{{ $rdv->car->name ?? 'Véhicule non spécifié' }}</td>
                                            <td>
                                                <span class="badge" style="background-color: {{ $statutColors[$rdv->statut] ?? '#6c757d' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $rdv->statut)) }}
                                                </span>
                                            </td>
                                            <td>

                                            <a href="{{ route('maintenance.show', $rdv->id) }}" 
                                       class="btn btn-sm btn-info load-content"
                                       data-url="{{ route('maintenance.show', $rdv->id) }}"
                                       title="Voir les détails">
                                       <i class="fas fa-eye"></i>
                                    </a>
                                    @if($rdv->status == 'pending')
                                                <form action="{{ route('client.rendezvous.destroy', $rdv->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Supprimer ce rendez-vous ?')">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $rendezvous->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    @else
        <!-- Contenu par défaut (statistiques admin) -->
        <div class="welcome-message">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-3">Bonjour, {{ Auth::user()->name }}!</h2>
                    <p class="lead mb-0">Bienvenue sur votre espace professionnel GF Showroom. Vous pouvez gérez votre activité facilement.</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>
        </div>

        @if(auth()->user()->role === 'admin' && isset($stats))
        @php
            $statsController = app(\App\Http\Controllers\StatisticsController::class);
            $stats = $statsController->getDashboardStats();
        @endphp
       <!-- Cards -->
<div class="row">
    <!-- Card Véhicules -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card">
            <i class="fas fa-car"></i>
            <h5>Véhicules</h5>
            <p class="text-primary">{{ $stats['total_cars'] }}</p>
            <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-primary" role="progressbar" 
                     style="width: {{ $stats['car_growth'] }}%;"></div>
            </div>
            <small class="text-muted">{{ $stats['car_growth'] }}% ce mois</small>
        </div>
    </div>
    
    <!-- Card Clients -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card">
            <i class="fas fa-users"></i>
            <h5>Clients</h5>
            <p class="text-success">{{ $stats['total_clients'] }}</p>
            <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-success" role="progressbar" 
                     style="width: {{ $stats['client_growth'] }}%;"></div>
            </div>
            <small class="text-muted">{{ $stats['client_growth'] }}% ce mois</small>
        </div>
    </div>
    
    <!-- Card Commandes -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card">
            <i class="fas fa-shopping-cart"></i>
            <h5>Commandes</h5>
            <p class="text-warning">{{ $stats['total_orders'] }}</p>
            <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-warning" role="progressbar" 
                     style="width: {{ $stats['order_growth'] }}%;"></div>
            </div>
            <small class="text-muted">{{ $stats['order_growth'] }}% ce mois</small>
        </div>
    </div>
    
    <!-- Card Revenus -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card">
            <i class="fas fa-chart-line"></i>
            <h5>Revenus</h5>
            <p class="text-danger">
                {{ number_format($stats['total_revenue'], 0, ' ', ' ') }} TND
            </p>
            <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-danger" role="progressbar" 
                     style="width: {{ $stats['revenue_growth'] }}%;"></div>
            </div>
            <small class="text-muted">{{ $stats['revenue_growth'] }}% ce mois</small>
        </div>
    </div>
</div>
        @endif

        <!-- User Info Section -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profil Utilisateur</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <div class="user-avatar mb-3">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <h6 class="fw-bold">{{ Auth::user()->name }}</h6>
                                <span class="badge bg-primary">{{ Auth::user()->role }}</span>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Email</label>
                                    <p class="mb-0">{{ Auth::user()->email }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Date d'inscription</label>
                                    <p class="mb-0">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label text-muted small mb-1">Dernière connexion</label>
                                    <p class="mb-0">{{ Auth::user()->last_login_at ? Auth::user()->last_login_at->diffForHumans() : 'Première connexion' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Colonne supplémentaire pour les admins -->
           
        </div>
    @endif
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Fonction principale pour charger le contenu dynamique
    function loadDynamicContent(url, pushState = true) {
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            if (data.success && data.content) {
                document.getElementById('dynamic-content').innerHTML = data.content;
                initDynamicContentEvents();
                if (pushState) {
                    history.pushState({url: url}, '', url);
                }
            } else if (data.redirect) {
                loadDynamicContent(data.redirect);
            } else {
                window.location.href = url; // Fallback
            }
        })
        .catch(error => {
            console.error('Error:', error);
            window.location.href = url; // Fallback si échec
        });
    }

    // Gestion des clics sur les liens dynamiques
    function handleDynamicClick(e) {
        // Pour les liens avec data-url (sidebar)
        if (e.target.closest('.load-content')) {
            e.preventDefault();
            const url = e.target.closest('.load-content').getAttribute('data-url');
            loadDynamicContent(url);
            return;
        }
        
        // Pour les liens normaux dans le contenu dynamique (show, edit, etc.)
        const dynamicLink = e.target.closest('a[href][data-dynamic]') || 
                          e.target.closest('a.btn-show') || 
                          e.target.closest('a.btn-edit');
        
        if (dynamicLink) {
            e.preventDefault();
            const url = dynamicLink.getAttribute('href');
            loadDynamicContent(url);
        }
    }

    // Gestion des formulaires dans le contenu dynamique
    function handleFormSubmit(e) {
        const form = e.target.closest('form[data-dynamic-form]');
        if (!form) return;
        
        e.preventDefault();
        const url = form.getAttribute('action');
        const method = form.getAttribute('method');
        const formData = new FormData(form);

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.content) {
                    document.getElementById('dynamic-content').innerHTML = data.content;
                    initDynamicContentEvents();
                }
                if (data.redirect) {
                    loadDynamicContent(data.redirect);
                }
                if (data.message) {
                    // Vous pouvez ajouter une notification ici
                    console.log(data.message);
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }

    // Initialisation des événements
    function initDynamicContentEvents() {
        // Réattache les événements aux nouveaux éléments chargés dynamiquement
        document.body.addEventListener('click', handleDynamicClick);
        document.body.addEventListener('submit', handleFormSubmit);
    }

    // Gestion du bouton retour
    window.addEventListener('popstate', function(event) {
        if (event.state && event.state.url) {
            loadDynamicContent(event.state.url, false);
        }
    });

    // Gestion spécifique du formulaire de filtres
    document.addEventListener('submit', function(e) {
        if (e.target.matches('form[data-dynamic-form]')) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);
            const url = form.action + '?' + new URLSearchParams(formData).toString();
            
            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('dynamic-content').innerHTML = data.content;
                    // Réinitialise les événements
                    initDynamicContentEvents();
                    // Met à jour l'URL dans la barre d'adresse
                    history.pushState(null, null, url);
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });

    // Initialisation au chargement
    initDynamicContentEvents();

    // Animation des cartes (conservée de votre script original)
    const animateCards = () => {
        document.querySelectorAll('.card').forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * index);
        });
    };
    animateCards();
});
function loadClientContent(url) {
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(data => {
        if (data.success && data.content) {
            // Remplace seulement le contenu dynamique
            document.getElementById('dynamic-content').innerHTML = data.content;
            
            // Réinitialise les événements
            initDynamicContentEvents();
            
            // Met à jour l'URL sans recharger
            history.pushState({url: url}, '', url);
            
            // Anime les nouveaux éléments
            animateCards();
        } else {
            window.location.href = url; // Fallback
        }
    })
    .catch(error => {
        console.error('Error:', error);
        window.location.href = url; // Fallback si échec
    });
}
function loadMaintenanceContent(url) {
    fetch(url, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Efface d'abord le contenu existant
            document.getElementById('dynamic-content').innerHTML = '';
            
            // Puis charge le nouveau contenu
            document.getElementById('maintenance-container').innerHTML = data.content;
            
            // Réinitialise les événements
            initDynamicContentEvents();
        }
    })
    .catch(error => console.error('Error:', error));
}


</script>
</body>
</html>