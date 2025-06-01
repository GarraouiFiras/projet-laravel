<!-- resources/views/forms/contact.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contactez-nous</title>
</head>
<body>
    <h1>Formulaire de contact</h1>

    {{-- Message de succès --}}
    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    {{-- Affichage des erreurs --}}
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf

        <label for="name">Nom :</label>
        <input type="text" name="name" value="{{ old('name') }}" required><br><br>

        <label for="email">Email :</label>
        <input type="email" name="email" value="{{ old('email') }}" required><br><br>

        <label for="subject">Sujet :</label>
        <input type="text" name="subject" value="{{ old('subject') }}" required><br><br>

        <label for="message">Message :</label><br>
        <textarea name="message" rows="5" required>{{ old('message') }}</textarea><br><br>

        <button type="submit">Envoyer</button>
    </form>
</body>
</html>
