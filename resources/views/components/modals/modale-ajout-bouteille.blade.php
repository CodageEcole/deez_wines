<dialog id="modal" class="modalePage">
    <form id="modal-form" class="formulairePage" method="POST" action="{{ route('cellier_quantite_bouteille.store') }}">
        <h2 id="modal-title"></h2>
        <hr>
        @csrf
        <div class="cellar-group">
            <div class="cellar-input">
                <label for="cellier_id">@lang('messages.cellar')</label>
            </div>
            <div class="cellar-input">
                <select name="cellier_id">
                    @foreach ($celliers as $cellier)
                        <option value="{{ $cellier->id }}">{{ $cellier->nom }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <hr>
        <div class="quantity-input">
            <label for="quantite">@lang('messages.quantity')</label>
        </div>
        <div class="plusMinus">
            <span class="quantity-btn minus-btn" onclick="decrementQuantity()">&#8722;</span>
            <input name="quantite" type="number" id="quantity" value="1" min="1">
            <span class="quantity-btn plus-btn" onclick="incrementQuantity()">&#43;</span>
        </div>
        <input type="hidden" name="bouteille_id" id="bouteille-id">
        <input type="hidden" name="source_page" value="bouteilles.index">
        <hr>
        <div class="modaleActions">
            <button type="button" class="boutonCellier" onclick="closeModal()">@lang('messages.cancel')</button>
            <button type="submit" class="boutonCellier">@lang('messages.add')</button>
        </div>
    </form>
    <form action="{{ route('liste_achat.show', ['liste_achat' => '1']) }}" method="get">
        <input type="hidden" name="bouteille_id_2" id="bouteille-id-2">
        <button type="submit" class="boutonCellier">@lang('messages.add_to_list')</button>
    </form>
</dialog>