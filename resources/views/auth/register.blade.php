<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div class="mb-3">
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="form-control" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('first_name')" class="text-danger mt-2" />
        </div>

        <!-- Last Name (Optional) -->
        <div class="mb-3">
            <x-input-label for="last_name" :value="__('Last Name (Optional)')" />
            <x-text-input id="last_name" class="form-control" type="text" name="last_name" :value="old('last_name')" autocomplete="family-name" />
            <x-input-error :messages="$errors->get('last_name')" class="text-danger mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <x-input-label for="phone" :value="__('Phone Number')" />
            <x-text-input id="phone" class="form-control" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('phone')" class="text-danger mt-2" />
        </div>

        <!-- Address -->
        <div class="mb-3">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="form-control" type="text" name="address" :value="old('address')" required autocomplete="street-address" />
            <x-input-error :messages="$errors->get('address')" class="text-danger mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-3">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="form-control"
                         type="password"
                         name="password"
                         required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="text-danger mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="form-control"
                         type="password"
                         name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="text-danger mt-2" />
        </div>

        <!-- Terms and Conditions Checkbox -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">
                {{ __('I agree to the terms and conditions') }}
            </label>
            <x-input-error :messages="$errors->get('terms')" class="text-danger mt-2" />
        </div>

        <div class="d-flex justify-content-center mt-4">
            <x-primary-button class="btn btn-dark ms-3">
                {{ __('Register') }}
            </x-primary-button>
        </div>
        <div class="text-center mt-3">
                        Already have an account?  <a class="text-decoration-none" href="{{ route('login') }}">Login here</a>
        </div>
    </form>
</x-guest-layout>