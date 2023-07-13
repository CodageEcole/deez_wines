<dialog class="modalePage">
    <form id="pageSelectorForm" class="formulairePage">
        @csrf
        <label for="selecteurPage">Sélecteur de page</label>
        <input type="text" name="selecteurPage" class="numeroPage" placeholder="entre 1 et {{ $dernierePage }}"  min="1" required data-derniere-page="{{$dernierePage}}">
        <button type="submit" class="page-button">Aller</button>
    </form>
</dialog>