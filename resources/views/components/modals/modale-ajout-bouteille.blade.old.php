<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modal-title"></h2> 
        <form id="modal-form" method="POST" action="{{ route('cellier_quantite_bouteille.store') }}">
        @csrf
        <select name="cellier_id">
            @foreach ($celliers as $cellier)
                <option value="{{ $cellier->id }}">{{ $cellier->nom }}</option>
            @endforeach
        </select>
        <div class="quantity-input">
            <span class="quantity-btn minus-btn" onclick="decrementQuantity()">&#8722;</span>
            <input name="quantite" type="number" id="quantity" value="1" min="1">
            <span class="quantity-btn plus-btn" onclick="incrementQuantity()">&#43;</span>
        </div>
        <input type="hidden" name="bouteille_id" id="bouteille-id">
        <div>
            <button type="submit" class="btn btn-primary btn-details">
                Ajouter
            </button>
            <button type="button" class="btn btn-secondary btn-details" onclick="closeModal()">
                Annuler
            </button>
        </div>
        </form>
    </div>
</div>