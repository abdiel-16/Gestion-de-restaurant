<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu du jour - Spécialités Ivoiriennes</title>
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
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


    <h1>🍛 Menu du Jour</h1>
    <p>Découvrez nos plats ivoiriens soigneusement préparés aujourd'hui</p>
    
    <main class="menu-container">

        @foreach ($categories as $categorie)
            <section class="categorie-section">
                <h2 class="categorie-title">{{ $categorie->name }}</h2>

                <div class="plats-grid">
                    @foreach ($categorie->plats as $plat)
                        <article class="menu-item">
                            <h3>{{ $plat->name }}</h3>
                            <p>{{ $plat->description }}</p>
                            <span>{{ $plat->prix }} FCFA</span>

                            <form action="{{ route('commande-ajouter', $plat->id) }}" method="POST" class="commande-form">
                                @csrf
                                <label for="quantite-{{ $plat->id }}">Quantité :</label>
                                <select name="quantite" id="quantite-{{ $plat->id }}">
                                    @for ($i = 1; $i <= 10; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <button type="submit">Commander</button>
                            </form>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach

    </main>


    <footer>
         &copy; 2025 Restaurant Ivoirien • Tous droits réservés
    </footer>
</body>
</html>
