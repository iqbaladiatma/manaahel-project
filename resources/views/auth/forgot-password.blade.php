<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('Forgot Password?') }}</h2>
        <p class="text-gray-600 dark:text-gray-400">{{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
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
                   class="w-full px-4 py-3 border border-gray-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-card text-gray-900 dark:text-gray-100 focus:ring-2 focus:ring-blue-light focus:border-blue-light transition-colors dark:border-dark-border dark:bg-dark-bg dark:text-gray-100"
                   placeholder="your@email.com">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-4 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary focus:outline-none focus:ring-2 focus:ring-blue-light focus:ring-offset-2:ring-offset-gray-900 transition-colors">
            {{ __('Email Password Reset Link') }}
        </button>
    </form>

    <!-- Back to Login -->
    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-blue-primary dark:text-gold hover:text-blue-primary dark:text-gold:text-emerald-300 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            {{ __('Back to login') }}
        </a>
    </div>
</x-guest-layout>


