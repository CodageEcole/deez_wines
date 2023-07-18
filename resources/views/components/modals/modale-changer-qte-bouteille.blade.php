<dialog class="changerQteBout">
    <form action="{{ route('cellier_quantite_bouteille.update', $quantiteBouteille->id)}}">
        @csrf
        <span class="quantity-btn plus-btn">&#43;</span>
        <input class="inputQuantite" type="number" value="">
        <span class="quantity-btn minus-btn">&#8722;</span>
        <button type="submit">Appliquer</button>
        <button>Annuler</button>
    </form>
</dialog>