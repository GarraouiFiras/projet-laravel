<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialiser le mot de passe - Showroom</title>
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
            background-image: url("{{ asset('assets/img/art.jpg') }}"); /* Chemin absolu */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
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
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px 50px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
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
            width: 100px;
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
            background-color: rgba(255, 255, 255, 0.8);
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
            transform: translateY(-3px);
        }

        button:active {
            transform: translateY(0);
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
        <form action="{{ route('password.update') }}" method="POST">
            <!-- Logo GF dans le formulaire -->
            <div class="logo">
                <img src="{{ asset('assets/img/logoo.png') }}" alt="Logo GF"> <!-- Chemin absolu -->
            </div>

            <h1>Réinitialiser le mot de passe</h1>
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}" required readonly>

            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre nouveau mot de passe" required>

            <label for="password_confirmation">Confirmez le mot de passe :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>

            <button type="submit">Réinitialiser le mot de passe</button>

            <div class="links">
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>
</html>