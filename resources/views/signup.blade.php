<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
            margin: 0;
            padding: 0;
        }

        .signup-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 40px 50px;
            border-radius: 12px;
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        /* Nouveau style pour le logo */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        .signup-container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.8em;
            color: #000;
        }

        .signup-container p {
            text-align: center;
            margin-bottom: 30px;
            color: #000;
        }

        .form-label {
            font-weight: 600;
            color: #000;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.8);
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px;
            font-size: 1em;
            color: #333;
        }

        .form-control:focus {
            outline: none;
            border-color: #6c63ff;
            box-shadow: 0 0 6px rgba(108, 99, 255, 0.3);
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            background-color: #6c63ff;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            color: #fff;
            cursor: pointer;
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4e46cc;
            transform: translateY(-3px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .text-danger {
            color: #ff4d4d;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <!-- Ajout du logo GF -->
        <div class="logo">
            <img src="{{ asset('assets/img/logoo.png') }}" alt="Logo GF">
        </div>
        
        <h1>{{ $title }}</h1>
        <p>Veuillez remplir le formulaire pour vous inscrire.</p>
        
        <form action="{{ route('signup.store') }}" method="POST">
            @csrf
            
            <!-- Civilité -->
            <div class="mb-3">
                <label for="civilite" class="form-label">Civilité</label>
                <select class="form-control" id="civilite" name="civilite" required>
                    <option value="">Sélectionnez votre civilité</option>
                    <option value="M.">M.</option>
                    <option value="Mme">Mme</option>
                    <option value="Mlle">Mlle</option>
                </select>
                @error('civilite')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Nom complet -->
            <div class="mb-3">
                <label for="name" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom complet" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Numéro de téléphone -->
              <div class="mb-3">
            <label for="telephone" class="form-label">Numéro de téléphone</label>
            <input type="tel" class="form-control" id="telephone" name="telephone" 
                   placeholder="Entrez votre numéro de téléphone (8 chiffres)" 
                   pattern="[0-9]{8}" 
                   title="Le numéro doit contenir exactement 8 chiffres" 
                   required>
            @error('telephone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            
        </div>
            
            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nom@exemple.com" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Mot de passe -->
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <!-- Confirmer le mot de passe -->
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirmez le mot de passe</label>
                <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
            </div>
            
            <!-- Bouton d'inscription -->
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">S'inscrire</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
     <script>
        // Validation JavaScript pour le champ téléphone
        document.getElementById('telephone').addEventListener('input', function(e) {
            // Ne garder que les chiffres
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limiter à 8 caractères
            if (this.value.length > 8) {
                this.value = this.value.slice(0, 8);
            }
        });

        // Validation avant soumission du formulaire
        document.querySelector('form').addEventListener('submit', function(e) {
            const telephone = document.getElementById('telephone');
            if (telephone.value.length !== 8) {
                e.preventDefault();
                alert('Le numéro de téléphone doit contenir exactement 8 chiffres');
                telephone.focus();
            }
        });
    </script>
</body>
</html>