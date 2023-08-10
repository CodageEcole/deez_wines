<dialog class="ajoutCellier" id="modal">
    <form action="{{ route('celliers.store') }}" method="POST">
        @csrf
        <input type="text" name="nom" id="nom" placeholder="@lang('messages.name_your_cellar')">
        <button class="" type="submit">@lang('messages.add')</button>
    </form>
</dialog>