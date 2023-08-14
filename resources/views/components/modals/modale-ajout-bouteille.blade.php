<dialog id="modal" class="modalePage">
    <form id="modal-form" class="formulairePage" method="POST" action="{{ route('cellier_quantite_bouteille.store') }}">
        <h2 id="modal-title"></h2>
        <div class="separation-modal"></div>
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
        <div class="separation-modal"></div>
        <div class="quantity-input">
            <label class="label-quantite" for="quantite">@lang('messages.quantity')</label>
        </div>
        <div class="plusMinus">
            <span class="quantity-btn minus-btn" onclick="decrementQuantity()"><img src="{{ asset('icons/minus_icon.svg') }}" alt=""></span>
            <input class="plus-minus-input" name="quantite" type="number" id="quantity" value="1" min="1">
            <span class="quantity-btn plus-btn" onclick="incrementQuantity()"><img src="{{ asset('icons/plus_icon.svg') }}" alt=""></span>
        </div>
        <input type="hidden" name="bouteille_id" id="bouteille-id">
        <input type="hidden" name="source_page" value="bouteilles.index">
        <div class="separation-modal"></div>
        <div class="modaleActions">
            <button type="button" class="boutonCellier-cancel" onclick="closeModal()">@lang('messages.cancel')<span class="material-symbols-outlined">close</span></button>
            <button type="submit" class="boutonCellier-add">@lang('messages.add')<span class="material-symbols-outlined">check</span></button>
        </div>
    </form>
    <form action="{{ route('liste_achat.show', ['liste_achat' => '1']) }}" method="get">
        <input type="hidden" name="bouteille_id_2" id="bouteille-id-2">
        <button type="submit" class="boutonCellier">@lang('messages.add_to_list')</button>
    </form>
</dialog>