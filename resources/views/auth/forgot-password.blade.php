<x-auth-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth.session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-form.input :label="__('Email')" id="email" class="block mt-1 w-full" type="email" name="email"
                :value="old('email')" required autofocus :errors="$errors->get('email')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-custom.button>
                {{ __('Email Password Reset Link') }}
            </x-custom.button>
        </div>
    </form>
</x-auth-layout>