<x-guest-layout>
    <x-auth.card>
        <!-- Session Status -->
        <x-auth.session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth.validation-errors class="mb-4" :errors="$errors" />

        <x-form action="{{ route('login') }}">
            <!-- Email Address -->
            <div>
                <x-form.input type="email"
                              name="email"
                              :value="old('email')"

                              autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-form.input type="password"
                              name="password"
                              required
                              autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <x-form.checkbox name="remember" id="remember_me" text="{{ __('Remember me') }}"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-navigation.link href="{{ route('register') }}" class="mr-auto">
                    {{ __('Register') }}
                </x-navigation.link>

                @if (Route::has('password.request'))
                    <x-navigation.link href="{{ route('password.request') }}" class="mr-2">
                        {{ __('Forgot your password?') }}
                    </x-navigation.link>
                @endif

                <x-form.button>
                    {{ __('Log in') }}
                </x-form.button>
            </div>
        </x-form>
    </x-auth.card>
</x-guest-layout>
