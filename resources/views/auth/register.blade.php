<x-guest-layout>
    <x-auth.card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth.validation-errors class="mb-4" :errors="$errors" />

        <x-form action="{{ route('register') }}">
            <!-- Name -->
            <div>
                <x-form.input name="name"
                              :value="old('name')"
                              required
                              autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-form.input type="email"
                              name="email"
                              :value="old('email')"
                              required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-form.input type="password"
                              name="password"
                              required
                              autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-form.input placeholder="confirm password"
                              type="password"
                              name="password_confirmation"
                              required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-navigation.link href="{{ route('login') }}" class="mr-2">
                    {{ __('Already registered?') }}
                </x-navigation.link>

                <x-form.button class="ml-4">
                    {{ __('Register') }}
                </x-form.button>
            </div>
        </x-form>
    </x-auth.card>
</x-guest-layout>
