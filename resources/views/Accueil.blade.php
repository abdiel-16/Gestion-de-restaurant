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
    <h1>Le Délicieux</h1>
    <nav>
      <a href="#">Accueil</a>
      <a href="#">Menu</a>
      <a href="#">Réservations</a>
      <a href="#">Contact</a>
    </nav>
  </header>

  <main>
    <section class="hero">
        <div class="carousel">
            <img src="{{ asset('images/img1.jpg') }}" alt="Plat africain 1" class="active">
            <img src="{{ asset('images/img2.jpg') }}" alt="Plat africain 2">
            <img src="{{ asset('images/img3.jpg') }}" alt="Plat africain 3">
        </div>
        <div class="hero-text">
            <h2>Bienvenue chez Le Délicieux</h2>
            <p>Découvrez nos plats savoureux préparés avec amour et des ingrédients frais de saison.</p>
        </div>
    </section>

    <section class="menu-preview">
      <article class="menu-item">
        <h3>Foutou/riz sauce graine</h3>
        <p>Foutou banane, riz nature accompagné de la bonne sauce graine.</p>
        <span>2000fcfa</span>
      </article>

      <article class="menu-item">
        <h3>Placali sauce kopè </h3>
        <p>De la fabuleuse sauce kopè qui vous fera vivre l'inoubliable.</p>
        <span>2000fcfa</span>
      </article>

      <article class="menu-item">
        <h3>Filet du pêcheur</h3>
        <p>Un cocktail des annimaux de mer accompagné de légumes sautés et sauce citronnée.</p>
        <span>15000fcfa</span>
      </article>
    </section>
  </main>

  <footer>
    Le Délice à vos portes 
  </footer>
</body>
</html>
