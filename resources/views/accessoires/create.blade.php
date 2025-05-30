<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Accessoire - Showroom</title>
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
            background-image: url('{{ asset("assets/img/art.jpg") }}');
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
            max-width: 500px;
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

        input[type="text"],
        input[type="number"],
        textarea,
        select,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 1em;
            color: #000;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #6c63ff;
            box-shadow: 0 0 6px rgba(108, 99, 255, 0.3);
        }

        textarea {
            min-height: 100px;
            resize: vertical;
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
        <form action="{{ route('accessoires.store') }}" method="POST" enctype="multipart/form-data">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('assets/img/logoo.png') }}" alt="Logo Showroom">
            </div>

            <h1>Ajouter un Accessoire</h1>
            @csrf
            
            <label for="nom">Nom de l'accessoire</label>
            <input type="text" name="nom" id="nom" required>
            
            <label for="description">Description</label>
            <textarea name="description" id="description"></textarea>
            
            <label for="prix">Prix (TND)</label>
            <input type="number" name="prix" id="prix" step="0.01" required>
            
            <label for="stock">Quantité en stock</label>
            <input type="number" name="stock" id="stock" required>
            
            <label for="image">Image de l'accessoire</label>
            <input type="file" name="image" id="image" accept="image/*" required>
            
            <button type="submit">Enregistrer l'accessoire</button>
        </form>
    </div>
</body>
</html>