<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                          type="email" name="email"
                          :value="old('email')" required autofocus
                          autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                          type="password" name="password" required
                          autocomplete="current-password"/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700
                              text-indigo-600 shadow-sm focus:ring-indigo-500
                              dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Remember me') }}
                </span>
            </label>
        </div>

        <!-- Forgot Password & Login Button -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400
                          hover:text-gray-900 dark:hover:text-gray-100 rounded-md
                          focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500
                          dark:focus:ring-offset-gray-800"
                   href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

       <!-- OR Separator -->
<div class="flex items-center justify-center my-6">
    <hr class="w-full border-gray-400">
    <span class="px-4 text-sm text-gray-500 font-medium">OR</span>
    <hr class="w-full border-gray-400">
</div>

<!-- Google Login Button -->
<div class="flex justify-center mt-4">
<a href="{{route('google-auth')}}">
    <button type="button" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-black hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
        <svg class="w-5 h-5 mr-2" viewBox="0 0 533.5 544.3" xmlns="http://www.w3.org/2000/svg">
            <path fill="#4285F4" d="M533.5 278.4c0-18.2-1.5-35.8-4.4-52.8H272.1v99.8h147.4c-6.3 33.8-25.5 62.4-54.6 81.5v67.5h88.2c51.4-47.4 81.4-117.3 81.4-196z"/>
            <path fill="#34A853" d="M272.1 544.3c73.7 0 135.6-24.4 180.8-66.2l-88.2-67.5c-24.6 16.5-56 26.1-92.6 26.1-71 0-131.3-47.9-152.8-112.5h-89.7v70.7c45.1 88.9 137.3 149.4 242.5 149.4z"/>
            <path fill="#FBBC05" d="M119.3 323.9c-10.7-31.7-10.7-65.8 0-97.5v-70.7h-89.7c-38.4 75.7-38.4 165.5 0 241.2l89.7-70.7z"/>
            <path fill="#EA4335" d="M272.1 107.7c39.9 0 75.8 13.7 104 40.7l78.2-78.2c-49.4-46-113.7-74.2-182.2-74.2-105.2 0-197.4 60.5-242.5 149.4l89.7 70.7c21.6-64.6 81.9-112.4 152.8-112.4z"/>
        </svg>
        Continue with Google
    </button>
</a>
</div>

    </form>
</x-guest-layout>
