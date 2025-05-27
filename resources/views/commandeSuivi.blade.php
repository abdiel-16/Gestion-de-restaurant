<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suivi de la commande</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

<header>
    <h1>Chez NOL'K</h1>
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

<main class="commande-container">
    <h2>Vos commandes en cours</h2>

    @if($commande && $commande->plats->count() > 0)
        @php $total = 0; @endphp

        @foreach($commande->plats as $plat)
            @php
                $sousTotal = $plat->prix * $plat->pivot->quantite;
                $total += $sousTotal;
            @endphp
            <div class="commande-item">
                <div class="plat-info">
                    <h3>{{ $plat->name }}</h3>
                    <p>Prix unitaire : {{ $plat->prix }} FCFA</p>
                    <p>Quantité : {{ $plat->pivot->quantite }}</p>
                </div>
                <div class="plat-total">
                    {{ $sousTotal }} FCFA
                </div>
            </div>
        @endforeach

        <div class="total-commande">
            Total : {{ $total }} FCFA
        </div>

        <form action="{{ route('commande-confirmer') }}" method="POST" >
            @csrf
            <button type="submit" class="confirmer-btn">✅ Confirmer la commande</button>
        </form>
    @else
        <p>Aucune commande en cours.</p>
    @endif
</main>

<footer>
    Le Délice à vos portes
</footer>

</body>
</html>
