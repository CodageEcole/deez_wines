<dialog class="changerQteBout">
    <form action="{{ route('cellier_quantite_bouteille.update', 0)}}" method="POST">
        @csrf
        @method('PUT')
        <span class="plus">&#43;</span>
        <input  name="nouvelleQuantite" class="inputQuantite" type="number" value="" min="1">
        <span class="moins">&#8722;</span>
        <button type="submit">Appliquer</button>
        <button>Annuler</button>
    </form>
</dialog>