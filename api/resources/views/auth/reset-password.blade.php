<x-auth-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token --> 
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <form-input label="Email" errors="{{ $errors->get('email') }}" id="email" class="block mt-1 w-full"
                type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <form-input label="Password" errors="{{ $errors->get('password') }}" id="password"
                class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <form-input label="Confirm Password" errors="{{ $errors->get('password_confirmation') }}"
                id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-custom.button>
                {{ __('Reset Password') }}
            </x-custom.button>
        </div>
    </form>
</x-auth-layout>
