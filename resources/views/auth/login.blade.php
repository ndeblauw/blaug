<x-guest-layout>
    <!-- Session Status -->
    <x-breeze.auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        @production
        @else
            <div class="mb-6 border-2 border-blue-950 bg-[#d9ff3f] px-3 py-2 text-xs font-bold text-blue-950">
                test@example.com + password OR nico@deblauwe.be + password
            </div>
        @endproduction

        <!-- Email Address -->
        <div>
            <x-breeze.input-label for="email" value="Email" />
            <x-breeze.text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-breeze.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-breeze.input-label for="password" value="Password" />

            <x-breeze.text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-breeze.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded-sm border-blue-950/30 text-blue-600 shadow-xs focus:ring-blue-600" name="remember">
                <span class="ms-2 text-sm text-blue-950/60">Remember me</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-blue-950/60 hover:text-blue-600 rounded-md focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-blue-600" href="{{ route('password.request') }}">
                    Forgot your password?
                </a>
            @endif

            <x-breeze.primary-button class="ms-3">
                Log in
            </x-breeze.primary-button>
        </div>
    </form>
</x-guest-layout>
