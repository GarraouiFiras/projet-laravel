<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Showroom</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('assets/img/art.jpg'); /* Image de fond */
            background-size: cover; /* Couvre toute la page */
            background-position: center; /* Centre l'image */
            background-repeat: no-repeat; /* Empêche la répétition */
            color: #333;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
            padding: 20px;
        }

        form {
            background-color: rgba(255, 255, 255, 0.1); /* Fond semi-transparent */
            padding: 40px 50px;
            border-radius: 12px;
            backdrop-filter: blur(10px); /* Effet de flou pour améliorer la lisibilité */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px; /* Ajustez la taille du logo selon vos besoins */
            height: auto;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8em;
            color: #000;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8); /* Fond semi-transparent pour les champs */
            font-size: 1em;
            color: #333;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #6c63ff;
            box-shadow: 0 0 6px rgba(108, 99, 255, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #6c63ff;
            color: #fff;
            font-size: 1.1em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        button:hover {
            background-color: #4e46cc;
            transform: translateY(-3px); /* Animation au survol */
        }

        button:active {
            transform: translateY(0); /* Effet de clic */
        }

        .error {
            background-color: rgba(255, 0, 0, 0.1);
            padding: 10px;
            border: 1px solid rgba(255, 0, 0, 0.3);
            border-radius: 5px;
            margin-bottom: 15px;
            color: #d00;
            text-align: center;
        }

        .links {
            text-align: center;
            margin-top: 20px;
        }

        .links a {
            color: #6c63ff;
            text-decoration: none;
            font-size: 0.9em;
            margin: 0 10px;
            transition: color 0.3s ease;
        }

        .links a:hover {
            color: #4e46cc;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Formulaire de connexion -->
        <form action="{{ route('login') }}" method="POST">
            <!-- Logo GF dans le formulaire -->
            <div class="logo">
                <img src="assets/img/logoo.png" alt="Logo GF">
            </div>

            <h1>Se connecter</h1>
            @csrf
            @if (session('error'))
                <div class="error">{{ session('error') }}</div>
            @endif
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>

            <button type="submit">Connexion</button>

            <div class="links">
            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                <a class="btn-getstarted" href="/signup">S'inscrire</a>

            </div>
        </form>
    </div>
</body>
</html>