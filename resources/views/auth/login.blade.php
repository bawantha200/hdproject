<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="alert alert-info mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="mb-3 form-check">
            <label for="remember_me" class="form-check-label">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <span class="ms-2">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="d-flex justify-content-between align-items-center">
            @if (Route::has('password.request'))
                <a class="text-decoration-none" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="btn btn-primary btn-dark ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="text-center mt-3">
            Don't have an account? <a class="text-decoration-none" href="/register">Register now</a>
        </div>
    </form>
</x-guest-layout>