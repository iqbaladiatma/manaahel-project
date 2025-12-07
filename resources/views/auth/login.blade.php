<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('Welcome Back') }}</h2>
        <p class="text-gray-600 dark:text-gray-400">{{ __('Sign in to your account to continue') }}</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Email') }}
            </label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autofocus 
                   autocomplete="username"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-card text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-light focus:border-blue-light transition-colors dark:border-dark-border dark:bg-dark-bg dark:text-gray-100"
                   placeholder="your@email.com">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                {{ __('Password') }}
            </label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="current-password"
                   class="w-full px-4 py-3 border border-gray-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-card text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-light focus:border-blue-light transition-colors dark:border-dark-border dark:bg-dark-bg dark:text-gray-100"
                   placeholder="••••••••">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" 
                       type="checkbox" 
                       name="remember"
                       class="w-4 h-4 rounded border-gray-300 dark:border-dark-border text-blue-primary dark:text-gold focus:ring-blue-light:ring-blue-primary transition-colors">
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-blue-primary dark:text-gold hover:text-blue-primary dark:text-gold:text-emerald-300 transition-colors">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-4 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary focus:outline-none focus:ring-2 focus:ring-blue-light focus:ring-offset-2:ring-offset-gray-900 transition-colors">
            {{ __('Sign In') }}
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300 dark:border-dark-border"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white dark:bg-dark-card text-gray-500 dark:text-gray-500">{{ __('Or') }}</span>
        </div>
    </div>

    <!-- Register Link -->
    <div class="text-center">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __("Don't have an account?") }}
            <a href="{{ route('register') }}" class="text-blue-primary dark:text-gold hover:text-blue-primary dark:text-gold:text-emerald-300 font-medium transition-colors">
                {{ __('Sign up for free') }}
            </a>
        </p>
    </div>
</x-guest-layout>


