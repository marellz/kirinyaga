<x-auth-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <form-input label="Name" errors="{{ $errors->first('name') }}" id="name" class="block mt-1 w-full"
                type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <form-input label="Email" errors="{{ $errors->first('email') }}" id="email" class="block mt-1 w-full"
                type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <form-input label="Password" errors="{{ $errors->first('password') }}" id="password"
                class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <form-input label="Confirm Password" errors="{{ $errors->first('password_confirmation') }}"
                id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation"
                required autocomplete="new-password" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                Already registered?
            </a>

            <x-custom.button class="ms-4">
             Register
            </x-custom.button>
        </div>
    </form>
</x-auth-layout>
