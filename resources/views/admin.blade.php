<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ajoutPlat.css') }}">
    
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
        <div class="section">
            <h2>Gestion des Menus</h2>
            <button id="openModalBtn">➕ Ajouter un plat</button>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($plats as $plat)
                        <tr>
                            <td>{{ $plat->name }}</td>
                            <td>{{ $plat->prix }} FCFA</td>
                            <td>{{ $plat->categorie->nom_categorie ?? 'Aucune' }}</td>
                            <td>
                                <a href="{{ route('plats-edit', $plat->id) }}">✏️</a>
                                <form action="{{ route('plats-destroy', $plat->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        

        </div>




        <div class="section">
            <h2>Gestion du Personnel</h2>
            <a href="{{ route('user-create') }}">➕ Ajouter du personnel</a>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($personnels as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin-user-role', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" onchange="this.form.submit()">
                                        <option value="cuisinier" {{ $user->role === 'cuisinier' ? 'selected' : '' }}>Cuisinier</option>
                                        <option value="serveur" {{ $user->role === 'serveur' ? 'selected' : '' }}>Serveur</option>
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin-user-supprimer', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    
        <div class="section">
            <h2>Liste des Clients</h2>
                <a href="{{ route('user-create') }}">➕ Ajouter un client</a>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>
                                <form action="{{ route('admin-user-role', $client->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" onchange="this.form.submit()">
                                        <option value="cuisinier" {{ $client->role === 'cuisinier' ? 'selected' : '' }}>Cuisinier</option>
                                        <option value="serveur" {{ $client->role === 'serveur' ? 'selected' : '' }}>Serveur</option>
                                        <option value="admin" {{ $client->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                        <option value="client" {{ $client->role === 'client' ? 'selected' : '' }}>Client</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin-user-supprimer', $client->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">🗑️ Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
 


        <div id="overlay"></div>
        <div id="modal" role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-hidden="true">
            <h2 id="modalTitle">🍽️ Ajouter un plat</h2>

            <div id="errors" class="alert" style="display:none;"></div>

            <form id="platForm" action="{{ route('plats-store') }}" method="POST">
                @csrf
                <label for="name">Nom du plat :</label>
                <input type="text" name="name" id="name" required>

                <label for="description">Description :</label>
                <textarea name="description" id="description" rows="4" required></textarea>

                <label for="prix">Prix (FCFA) :</label>
                <input type="number" name="prix" id="prix" required>

                <label for="categorie_id">Catégorie :</label>
                <select name="categorie_id" id="categorie_id" required>
                    <option value="">-- Sélectionner une catégorie --</option>
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                    @endforeach
                </select>

                <button type="submit">Ajouter</button>
                <button type="button" id="closeModalBtn">Annuler</button>
            </form>
        </div>

        <script src="{{ asset('js/plat-create.js') }}"></script>

</body>
</html>