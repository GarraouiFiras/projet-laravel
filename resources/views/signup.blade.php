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
            background-color: #f8f9fa;
            padding: 20px;
        }
        .signup-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        .signup-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="signup-container">
    <h1>{{ $title }}</h1>
    <p class="text-center">Veuillez remplir le formulaire pour vous inscrire.</p>
    <form action="{{ route('signup.store') }}" method="POST">

    @csrf
    <!-- Nom complet -->
    <div class="mb-3">
        <label for="name" class="form-label">Nom complet</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom complet" required>
        @error('name')
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
</body>
</html>
