<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="{{ asset('css/inscription.css') }}">
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>

        <form action="{{ route('inscription-B') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Adresse Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <p>Vous avez déjà un compte? <a href="{{ route('connexionShow') }}">Connectez-vous</a></p>

            <button type="submit">S'inscrire</button>
        </form>
    </div>
</body>
</html>
