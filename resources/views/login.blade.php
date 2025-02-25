<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            background: linear-gradient(135deg, #e0e0e0, #f5f5f5); /* Arrière-plan professionnel avec un dégradé léger */
            color: #333;
        }

        form {
            background-color: #ffffff;
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
            color: #444;
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
            background-color: #f9f9f9;
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
    <form action="{{ route('login') }}" method="POST">
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
    </form>
</body>
</html>
