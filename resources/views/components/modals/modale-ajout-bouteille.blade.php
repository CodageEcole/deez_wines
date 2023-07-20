<dialog id="modal" class="modalePage">
    <form id="modal-form" class="formulairePage" method="POST" action="{{ route('cellier_quantite_bouteille.store') }}">
        <h2 id="modal-title"></h2>
        <hr>
        @csrf
        <div class="quantity-input">
            <label for="cellier_id">Cellier</label>
        </div>
        <div class="quantity-input">
            <select name="cellier_id">
                @foreach ($celliers as $cellier)
                    <option value="{{ $cellier->id }}">{{ $cellier->nom }}</option>
                @endforeach
            </select>
        </div>
        <hr>
        <div class="quantity-input">
            <label for="quantite">Quantité</label>
        </div>
                <div class="plusMinus">
                    <span class="quantity-btn plus-btn" onclick="incrementQuantity()">&#43;</span>
                    <input name="quantite" type="number" id="quantity" value="1" min="1">
                    <span class="quantity-btn minus-btn" onclick="decrementQuantity()">&#8722;</span>
                </div>

        <input type="hidden" name="bouteille_id" id="bouteille-id">
        <input type="hidden" name="source_page" value="bouteilles.index">
        <hr>
        <div class="modaleActions">
            <button type="submit" class="boutonCellier">Ajouter</button>
            <button type="button" class="boutonCellier" onclick="closeModal()">Annuler</button>
        </div>
    </form>
</dialog>