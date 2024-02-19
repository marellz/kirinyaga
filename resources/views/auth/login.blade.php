<x-auth-layout>
    <!-- Session Status -->
    <x-auth.session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <form-input label="Email" error="{{ $errors->first('email') }}" id="email" class="block mt-1 w-full"
                type="email" name="email" model-value="{{old('email')}}" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <form-input label="Password" id="password" class="block mt-1 w-full" type="password" name="password"
                required autocomplete="current-password" errors="{{$errors->first('password')}}" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <x-form.checkbox id="remember_me" name="remember">
                {{ __('Remember me') }}
            </x-form.checkbox>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-custom.button class="ms-3">
                {{ __('Log in') }}
            </x-custom.button>
        </div>
    </form>
</x-auth-layout>
