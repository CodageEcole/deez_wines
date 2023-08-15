<dialog id="updateDialog">
    <h2>@lang('admin.update_user_title')</h2>
    <form id="updateForm" method="POST" action="{{ route('admin.update', ['user' => $usager->id]) }}">
        @csrf
        @method('PATCH')
        <input type="hidden" id="userId" name="userId">
        <div>
            <label for="username">@lang('admin.new_username') :</label>
            <input type="text" id="username" name="username" required><br><br>
    
            <label for="email">@lang('admin.new_email'):</label>
            <input type="email" id="email" name="email" required><br><br>
        </div>
        <button class="boutonCellier espace" type="submit">Mettre à Jour</button>
        <button class="boutonCellier espace" id="closeDialog">Fermer</button>
    </form>
</dialog>