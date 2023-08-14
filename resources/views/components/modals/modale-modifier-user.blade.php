<dialog id="updateDialog">
    <h2>Mettre à Jour l'Utilisateur</h2>

    <form method="POST" action="{{ route('admin.users.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT') <!-- Utilisation de la méthode PUT -->

        <label for="username">Nouveau Nom d'Utilisateur:</label>
        <input type="text" id="username" name="username" value="{{ $user->username }}" required><br><br>

        <label for="email">Nouvelle Adresse E-mail:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}" required><br><br>

        <button type="submit">Mettre à Jour</button>
    </form>
    <button id="closeDialog">Fermer</button>
</dialog>