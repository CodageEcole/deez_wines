<dialog id="modal">
    <form action="{{ route('celliers.store') }}" method="POST">
        @csrf
        <div>
            <label for="nom">Nom de votre cellier</label>
            <input type="text" name="nom" id="nom">
        </div>
        <div>
            <button class="" type="submit">Ajouter</button>
        </div>
    </form>
</dialog>