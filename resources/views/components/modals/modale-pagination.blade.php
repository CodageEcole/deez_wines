<dialog class="modalePage">
    <form id="pageSelectorForm" class="formulairePage">
        @csrf
        <label for="selecteurPage">Sélecteur de page</label>
    <input type="text" name="selecteurPage" class="numeroPage" placeholder="entre 1 et {{ $dernierePage }}"  min="1" max="{{ $dernierePage }}" required>
    <button type="submit" class="page-button">Aller</button>
    </form>
</dialog>