<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Lien vers les fichiers CSS communs -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header >
        <nav>
            <!-- Menu de navigation commun -->
            <ul>
                <li><a href="/">Accueil</a></li>
                <li><a href="/about">À propos</a></li>
                <li><a href="/contact">Contact</a></li>
                <li><a href="/services">Services</a></li> 
            </ul>
        </nav>
    </header>

    <main>
        <!-- Contenu spécifique de la page sera ici -->
        @yield('content')
    </main>

    <footer>
        <p>&copy; 2024 Mon Application. Tous droits réservés.</p>
    </footer>

    <!-- Lien vers les scripts JS communs -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
