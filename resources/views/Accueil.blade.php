<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Accueil - Restaurant</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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

  <main>
    <section class="hero">
        <div class="carousel">
            <img src="{{ asset('images/attiekepoulet.jpg') }}" alt="Plat africain 1" >
            <img src="{{ asset('images/gombo.jpg') }}" alt="Plat africain 2">
            <img src="{{ asset('images/patatepoisson.jpg') }}" alt="Plat africain 3">
            <img src="{{ asset('images/foutousauce.jpg') }}" alt="Plat africain 4">
            <img src="{{ asset('images/allocopoulet.jpg') }}" alt="Plat africain 3">
        </div>
        <div class="hero-text">
            <h2>Bienvenue chez NOL'K</h2>
            <p>Découvrez nos plats savoureux préparés avec amour et des ingrédients frais de saison.</p>
        </div>
    </section>

    <section class="menu-preview">

      <div class="menu-grid">
        @foreach($platsDuJour as $plat)
          <article class="menu-item">
            <h3>{{ $plat->name }}</h3>
            <p>{{ $plat->description }}</p>
            <span>{{ $plat->prix }} FCFA</span>
            <form action="{{ route('commande-ajouter', $plat->id) }}" method="POST">
              @csrf
              <button type="submit">➕ Ajouter à la commande</button>
            </form>
          </article>
        @endforeach
      </div>
    </section>


  </main>

  <footer>
    Le Délice à vos portes 
  </footer>
</body>
</html>