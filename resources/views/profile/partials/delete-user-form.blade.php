<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <x-custom.button
        variant="danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Delete Account') }}</x-custom.button>

    <x-utils.modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">

                <x-form.input
                    :label="__('Password')"
                    labelClass="sr-only"
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                    :errors="$errors->userDeletion->get('password')"
                />

            </div>

            <div class="mt-6 flex justify-end">
                <x-custom.button variant="secondary" x-on:click="$dispatch('close')" type="button">
                    {{ __('Cancel') }}
                </x-custom.button>

                <x-custom.button variant="danger" class="ms-3">
                    {{ __('Delete Account') }}
                </x-custom.button>
            </div>
        </form>
    </x-utils.modal>
</section>
