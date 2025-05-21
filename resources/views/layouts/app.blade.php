<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Showroom GF - Application professionnelle">
    <title>Showroom GF</title>
    <!-- Liens CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Police Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Styles personnalisés -->
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2c3e50;
            --accent-color: #e74c3c;
            --light-color: #f8f9fa;
            --dark-color: #2c3e50;
            --text-color: #333;
        }
        
        body {
            font-family: 'Montserrat', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: 0;
        }
        
        /* Navbar professionnelle */
        .navbar {
            background-color: rgba(255, 255, 255, 0.96) ;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 1px 15px rgba(0, 0, 0, 0.08);
            border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            padding: 0.2rem 0;
            min-height: 50px; 
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(-100%);
        }
        
        .navbar.visible {
            transform: translateY(0);
        }
        
        .navbar-brand {
            font-weight: 600;
            color: var(--secondary-color) ;
            display: flex;
            align-items: center;
            font-size: 1rem;
            letter-spacing: 0.5px;
             padding: 0.25rem 0;
        }
        
        .navbar-brand img {
            height: 24px;
            margin-right: 8px;
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: scale(1.08);
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--text-color) ;
            transition: all 0.3s;
             padding: 0.25rem 0.7rem; 
            font-size: 0.88rem;
            border-radius: 4px;
        }
        
        .nav-link:hover {
            color: var(--primary-color);
            background-color: rgba(52, 152, 219, 0.05);
        }
        
        .nav-link.active {
            color: var(--primary-color) ;
            background-color: rgba(52, 152, 219, 0.1);
        }
        
        .btn-outline-danger {
            border-width: 1.5px;
            font-weight: 500;
            padding: 0.35rem 0.75rem;
            font-size: 0.88rem;
            border-radius: 6px;
            transition: all 0.3s;
        }
        
        .btn-outline-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 8px rgba(220, 53, 69, 0.2);
        }
        
        /* Contenu principal */
        .container {
            flex: 1;
            padding-top: 1.5rem;
            padding-bottom: 2rem;
        }
        
        /* Pied de page */
        footer {
            background-color: var(--secondary-color);
            color: white;
            padding: 1.5rem 0;
            font-size: 0.9rem;
        }
        
        footer a {
            color: rgba(255, 255, 255, 0.7);
            transition: color 0.3s;
            text-decoration: none;
        }
        
        footer a:hover {
            color: white;
        }
        
        /* Animation navbar */
        @keyframes slideDown {
            from { 
                transform: translateY(-100%);
                opacity: 0;
            }
            to { 
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .navbar.visible {
            animation: slideDown 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
        
        /* Effet de transition douce */
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body>
    <!-- Barre de navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand smooth-transition" href="/">
                <img src="/assets/img/logoo.png" alt="Logo GF" class="smooth-transition">
                Showroom GF
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active smooth-transition" href="/">Accueil</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Pied de page -->
    <footer class="py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <p>&copy; 2025 Showroom Garraoui Firas. Tous droits réservés.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="#" class="text-white me-3 smooth-transition"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-white me-3 smooth-transition"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white me-3 smooth-transition"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-white smooth-transition"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navbar = document.querySelector('.navbar');
            
            // Affiche la navbar uniquement en haut de page
            function handleScroll() {
                if (window.pageYOffset <= 10) {
                    navbar.classList.add('visible');
                } else {
                    navbar.classList.remove('visible');
                }
            }
            
            // Vérifie la position au chargement
            handleScroll();
            
            // Écoute l'événement de scroll
            window.addEventListener('scroll', handleScroll);
            
            // Active les tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>