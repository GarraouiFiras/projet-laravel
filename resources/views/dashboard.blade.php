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
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo-container">
      <img src="assets/img/logoo.png" alt="GF Showroom" class="logo">
    </div>
    <a href="{{ url('/') }}"><i class="fas fa-home"></i> <span>Accueil</span></a>
     @auth
      @if(auth()->user()->role === 'admin') <!-- Vérification du rôle admin -->
    <a href="/statistiques"><i class="fas fa-tachometer-alt"></i> <span>Tableau de bord</span></a>
    <a href="/commandes"><i class="fas fa-shopping-cart"></i> <span>Commandes</span></a>
     @endif
    @endauth 
    <a href="/produit"><i class="fas fa-car"></i> <span>Véhicules</span></a>
    <a href="#settings"><i class="fas fa-cog"></i> <span>Paramètres</span></a>
    <a href="#help"><i class="fas fa-question-circle"></i> <span>Aide</span></a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mt-auto">
      <i class="fas fa-sign-out-alt"></i> <span>Déconnexion</span>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
  </div>

  <!-- Content -->
  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
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

    <!-- Welcome Message -->
    <div class="welcome-message">
      <div class="row align-items-center">
        <div class="col-md-8">
          <h2 class="fw-bold mb-3">Bonjour, {{ Auth::user()->name }}!</h2>
          <p class="lead mb-0">Bienvenue sur votre espace professionnel GF Showroom. Consultez les statistiques et gérez votre activité facilement.</p>
        </div>
        <div class="col-md-4 text-md-end">
          <div class="user-avatar">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
          </div>
        </div>
      </div>
    </div>

    <!-- Stats Cards -->
<div class="row">
    <!-- Card 1 - Véhicules -->
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
    
    <!-- Card 2 - Clients -->
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
    
    <!-- Card 3 - Commandes -->
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
    
    <!-- Card 4 - Revenus -->
    <div class="col-lg-3 col-md-6 mb-4">
        <div class="card stat-card">
            <i class="fas fa-chart-line"></i>
            <h5>Revenus</h5>
            <p class="text-danger">{{ number_format($stats['total_revenue'], 0, ',', ' ') }} €</p>
            <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-danger" role="progressbar" 
                     style="width: {{ $stats['revenue_growth'] }}%;"></div>
            </div>
            <small class="text-muted">{{ $stats['revenue_growth'] }}% ce mois</small>
        </div>
    </div>
</div>
    <!-- User Info Section -->
    <div class="row">
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-user-circle me-2"></i>Profil Utilisateur</h5>
            <a href="#edit" class="btn btn-sm btn-outline-light">Modifier</a>
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
      
      <!-- Recent Activity -->
      <div class="col-lg-6 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-bell me-2"></i>Activité Récente</h5>
          </div>
          <div class="card-body p-0">
            <div class="list-group list-group-flush">
              <a href="#" class="list-group-item list-group-item-action border-0">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">Nouvelle commande #1254</h6>
                  <small class="text-muted">15 min</small>
                </div>
                <p class="mb-1 small">Un client a commandé une BMW Série 3</p>
              </a>
              <a href="#" class="list-group-item list-group-item-action border-0">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">Maintenance programmée</h6>
                  <small class="text-muted">2h</small>
                </div>
                <p class="mb-1 small">Mercedes Classe A à réviser demain</p>
              </a>
              <a href="#" class="list-group-item list-group-item-action border-0">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">Nouveau message</h6>
                  <small class="text-muted">5h</small>
                </div>
                <p class="mb-1 small">Demande de renseignements sur une Audi Q5</p>
              </a>
              <a href="#" class="list-group-item list-group-item-action border-0">
                <div class="d-flex w-100 justify-content-between">
                  <h6 class="mb-1">Mise à jour stock</h6>
                  <small class="text-muted">1j</small>
                </div>
                <p class="mb-1 small">5 nouveaux accessoires ajoutés</p>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Animation pour les cartes au chargement
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.card');
      cards.forEach((card, index) => {
        setTimeout(() => {
          card.style.opacity = '1';
          card.style.transform = 'translateY(0)';
        }, 100 * index);
        
        // Style initial pour l'animation
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease';
      });
    });
  </script>
</body>
</html>