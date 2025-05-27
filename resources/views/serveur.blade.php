<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord du serveur</title>
    <link rel="stylesheet" href="{{ asset('css/serveur.css') }}">
</head>
<body>

    <header>
    <h1>NOL'K</h1>
        <nav>
        <a href="{{ route('accueilShow') }}">Accueil</a>
        <a href="{{ route('menu') }}">Menu</a> 
        <a href="{{ route('commande-suivi') }}">Commande</a>
        <a href="#">Contact</a>
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin-dashboard') }}">Admin</a>
        @endif
        @if (Auth::user()->role === 'serveur' || Auth::user()->role === 'admin')
            <a href="{{ route('serveur-dashboard') }}">Serveur</a>
        @endif
        @if (Auth::user()->role === 'cuisinier' || Auth::user()->role === 'admin')
            <a href="{{ route('cuisinier-dashboard') }}">Cuisinier</a>
        @endif

        <span>{{ Auth::user()->name }} (Connecté)</span>

        </nav>
    </header>

    <div class="container">
        <h1 class="title">🧾 Tableau de bord du serveur</h1>
        @foreach($commandes as $commande)
            <div class="card">
                <div class="card-body">
                    <h2>Commande #{{ $commande->id }} - Table {{ $commande->table->numero }}</h2>
                    <p><strong>Status :</strong> {{ ucfirst($commande->statut) }}</p>

                    <ul>
                        @foreach($commande->plats as $plat)
                            <li>{{ $plat->name }} (x{{ $plat->pivot->quantite }})</li>
                        @endforeach
                    </ul>


                        <form action="{{ route('commandes-servie', $commande->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">✅ Marquer comme servie</button>
                        </form>

                </div>
            </div>
        @endforeach
    </div>
</body>
</html>