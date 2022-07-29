<x-guest-layout>
    <x-auth.card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth.validation-errors class="mb-4" :errors="$errors" />

        <x-form action="{{ route('password.update') }}">
            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-form.input type="email"
                              name="email"
                              :value="old('email', $request->email)"
                              required
                              autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-form.input type="password"
                         name="password"
                         required />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-form.input type="password"
                         placeholder="Confirm password"
                         name="password_confirmation"
                         required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-form.button>
                    {{ __('Reset Password') }}
                </x-form.button>
            </div>
        </x-form>
    </x-auth.card>
</x-guest-layout>
