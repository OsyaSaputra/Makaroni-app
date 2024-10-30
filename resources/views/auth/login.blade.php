<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Kata Sandi')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        {{--<div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-200 border-gray-300 dark:border-gray-500 text-indigo-400 shadow-sm  " name="remember">
                <span class="ms-2 text-sm text-gray-400 dark:text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>--}}


        <div class="flex items-center gap-10 justify-items-center mt-4 ">

            <a class="font-bold text-sm text-black dark:text-gray-700 hover:text-gray-900 dark:hover:text-gray-400 rounded-md " href="{{ route('register') }}">
                {{ __('Belum Punya Akun?') }}
            </a>

            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-400 dark:text-gray-600 hover:text-gray-900 dark:hover:text-gray-100 rounded-md " href="{{ route('password.request') }}">
                {{ __('Lupa Password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>