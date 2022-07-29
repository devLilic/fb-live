<x-guest-layout>
    <x-auth.card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <!-- Validation Errors -->
        <x-auth.validation-errors class="mb-4" :errors="$errors" />

        <x-form action="{{ route('password.confirm') }}">
            <!-- Password -->
            <div>
                <x-form.label for="password" :value="__('Password')" />

                <x-form.input type="password"
                         name="password"
                         required
                         autocomplete="current-password" />
            </div>

            <div class="flex justify-end mt-4">
                <x-form.button>
                    {{ __('Confirm') }}
                </x-form.button>
            </div>
        </x-form>
    </x-auth.card>
</x-guest-layout>
