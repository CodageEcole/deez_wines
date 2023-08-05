<section>
    <header>
        <h2>{{ __('messages.delete_account') }}</h2>
        <p>{{ __('messages.delete_account_text') }}</p>
    </header>

        <x-danger-button class="profilSupprimergs" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
>{{ __('messages.delete_account') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="loginForm">
            @csrf
            @method('delete')

            <h2>{{ __('messages.delete_account_text_small') }}</h2>
            <p>{{ __('messages.delete_account_text') }}</p>

            <div>
                <x-input-label for="password" value="{{ __('messages.password') }}" />
                <x-text-input id="password" name="password" type="password" placeholder="{{ __('Password') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div>
                <x-secondary-button x-on:click="$dispatch('close')">{{ __('messages.cancel') }}</x-secondary-button>
                <x-danger-button>{{ __('messages.delete_account') }}</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
