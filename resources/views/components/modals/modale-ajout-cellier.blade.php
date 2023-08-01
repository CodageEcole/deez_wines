<dialog id="modal">
    <form action="{{ route('celliers.store') }}" method="POST">
        @csrf
        <div>
            <input type="text" name="nom" id="nom" placeholder="@lang('messages.name_your_cellar')">
        </div>
        <div>
            <button class="" type="submit">@lang('messages.add')</button>
        </div>
    </form>
</dialog>