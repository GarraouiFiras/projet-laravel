<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié - Showroom</title>
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
            background-color: rgba(255, 255, 255, 0.9);
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 1s ease-in-out;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.8em;
            color: #000; /* Couleur noire */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 1em;
            color: #333;
        }

        input[type="email"]:focus {
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

        .success {
            background-color: rgba(0, 255, 0, 0.1);
            padding: 10px;
            border: 1px solid rgba(0, 255, 0, 0.3);
            border-radius: 5px;
            margin-bottom: 15px;
            color: #0a0;
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
        <form action="{{ route('password.email') }}" method="POST">
            <h1>Mot de passe oublié</h1>
            @csrf
            @if (session('status'))
                <div class="success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="error">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required>

            <button type="submit">Envoyer le lien de réinitialisation</button>

            <div class="links">
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>
</html>