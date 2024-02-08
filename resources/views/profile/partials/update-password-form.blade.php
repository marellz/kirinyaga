<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-form.input :label="__('Current Password')" :errors="$errors->updatePassword->get('current_password')" id="update_password_current_password"
                name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
        </div>

        <div>
            <x-form.input :label="__('New Password')" :errors="$errors->updatePassword->get('password')" id="update_password_password" name="password"
                type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div>
            <x-form.input :label="__('Confirm Password')" :errors="$errors->updatePassword->get('password_confirmation')" id="update_password_password_confirmation"
                name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
        </div>

        <div class="flex items-center gap-4">
            <x-custom.button>{{ __('Save') }}</x-custom.button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
