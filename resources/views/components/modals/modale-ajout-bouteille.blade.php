<dialog id="modal" class="modalePage">
    <form id="modal-form" class="formulairePage" method="POST" action="{{ route('cellier_quantite_bouteille.store') }}">
        {{-- <span class="close" onclick="closeModal()">&times;</span> --}}
        <h2 id="modal-title"></h2>
        <hr>
        @csrf
        <label for="cellier_id">Sélection du cellier</label>
        <select name="cellier_id">
            @foreach ($celliers as $cellier)
                <option value="{{ $cellier->id }}">{{ $cellier->nom }}</option>
            @endforeach
        </select>
        <hr>
        <div class="quantity-input">
            <div>
                <label for="quantite">Quantité à ajouter</label>
                <input name="quantite" type="number" id="quantity" value="1" min="1">
            </div>
            <div class="plusMinus">
                <span class="quantity-btn plus-btn" onclick="incrementQuantity()">&#43;</span>
                <span class="quantity-btn minus-btn" onclick="decrementQuantity()">&#8722;</span>
            </div>
        </div>
        <input type="hidden" name="bouteille_id" id="bouteille-id">
        <input type="hidden" name="source_page" value="bouteilles.index">
        <hr>
        <div class="modaleActions">
            <button type="submit" class="btn btn-primary btn-details">Ajouter</button>
            <button type="button" class="btn btn-secondary btn-details" onclick="closeModal()">Annuler</button>
        </div>
    </form>
</dialog>