<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="{{ asset('css/connexion.css') }}">
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>

        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form action="{{ route('connexion-B') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="login">Nom ou Email</label>
                <input type="text" id="login" name="login" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>
