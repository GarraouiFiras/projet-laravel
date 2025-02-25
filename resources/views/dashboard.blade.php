<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Professional Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #e9ecef;
      font-family: 'Arial', sans-serif;
    }
    .sidebar {
      background: linear-gradient(180deg, #343a40, #212529);
      height: 100vh;
      position: fixed;
      width: 250px;
      top: 0;
      left: 0;
      display: flex;
      flex-direction: column;
    }
    .sidebar a {
      color: #f8f9fa;
      padding: 12px 20px;
      display: block;
      text-decoration: none;
      font-size: 16px;
      transition: background-color 0.3s;
    }
    .sidebar a:hover {
      background-color: #495057;
      border-left: 5px solid #0d6efd;
    }
    .sidebar .logo {
      text-align: center;
      padding: 15px 0;
      color: #f8f9fa;
      font-size: 24px;
      font-weight: bold;
      background-color: #0d6efd;
    }
    .content {
      margin-left: 250px;
      padding: 30px;
    }
    .card {
      border-radius: 10px;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .logout-btn {
      background-color: #dc3545;
      color: white;
      border: none;
    }
    .logout-btn:hover {
      background-color: #bb2d3b;
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="logo">Dashboard Pro</div>
    <a href="{{ url('/') }}"><i class="fas fa-home"></i> Page d'accueil</a>
    <a href="#overview"><i class="fas fa-tachometer-alt"></i> Overview</a>
    <a href="#reports"><i class="fas fa-chart-line"></i> Reports</a>
    <a href="#settings"><i class="fas fa-cog"></i> Settings</a>
    <a href="#help"><i class="fas fa-question-circle"></i> Help</a>
    <a href="#logout" class="mt-auto"><i class="fas fa-sign-out-alt"></i> Logout</a>
  </div>

  <!-- Content -->
  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light rounded mb-4">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <div class="d-flex">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn logout-btn">Logout</button>
          </form>
        </div>
      </div>
    </nav>

    <!-- Welcome Message -->
    <h1 class="mb-4">Bienvenue sur votre Dashboard, {{ Auth::user()->name }}!</h1>

    <div class="row">
      <!-- User Info Section -->
      <div class="col-md-4">
        <div class="card">
          <div class="card-header text-center bg-primary text-white">
            <i class="fas fa-user fa-3x"></i>
            <h5 class="mt-2">Informations Utilisateur</h5>
          </div>
          <div class="card-body">
            <p><strong>Nom :</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email :</strong> {{ Auth::user()->email }}</p>
            <p><strong>Date d'inscription :</strong> {{ Auth::user()->created_at->format('d M Y') }}</p>
            <p><strong>Rôle :</strong> {{ Auth::user()->role }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Other Content -->
    <div class="row mt-4">
      <!-- Card 1 -->
      <div class="col-lg-4 col-md-6">
        <div class="card mb-4">
          <div class="card-body text-center">
            <i class="fas fa-users fa-3x text-primary mb-3"></i>
            <h5 class="card-title">Utilisateurs</h5>
            <p class="card-text">1,234 utilisateurs actifs</p>
          </div>
        </div>
      </div>
      <!-- Card 2 -->
      <div class="col-lg-4 col-md-6">
        <div class="card mb-4">
          <div class="card-body text-center">
            <i class="fas fa-chart-bar fa-3x text-success mb-3"></i>
            <h5 class="card-title">Revenus</h5>
            <p class="card-text">$45,678</p>
          </div>
        </div>
      </div>
      <!-- Card 3 -->
      <div class="col-lg-4 col-md-6">
        <div class="card mb-4">
          <div class="card-body text-center">
            <i class="fas fa-comments fa-3x text-warning mb-3"></i>
            <h5 class="card-title">Commentaires</h5>
            <p class="card-text">89 nouveaux messages</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
