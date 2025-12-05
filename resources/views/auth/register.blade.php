<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ __('Create Account') }}</h2>
        <p class="text-gray-600">{{ __('Join our community today') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Full Name') }}
            </label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-light focus:border-blue-light transition-colors"
                   placeholder="John Doe">
            @error('name')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Email') }}
            </label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-light focus:border-blue-light transition-colors"
                   placeholder="your@email.com">
            @error('email')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Password') }}
            </label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-light focus:border-blue-light transition-colors"
                   placeholder="••••••••">
            @error('password')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
            <p class="mt-2 text-xs text-gray-500">{{ __('Minimum 8 characters') }}</p>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                {{ __('Confirm Password') }}
            </label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 focus:ring-2 focus:ring-blue-light focus:border-blue-light transition-colors"
                   placeholder="••••••••">
            @error('password_confirmation')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Terms & Conditions -->
        <div class="flex items-start">
            <input id="terms" 
                   type="checkbox" 
                   name="terms"
                   required
                   class="w-4 h-4 mt-1 rounded border-gray-300 text-blue-primary focus:ring-blue-light:ring-blue-primary transition-colors">
            <label for="terms" class="ml-2 text-sm text-gray-600">
                {{ __('I agree to the') }}
                <a href="#" class="text-blue-primary hover:text-blue-primary:text-emerald-300 transition-colors">{{ __('Terms of Service') }}</a>
                {{ __('and') }}
                <a href="#" class="text-blue-primary hover:text-blue-primary:text-emerald-300 transition-colors">{{ __('Privacy Policy') }}</a>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full px-4 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary focus:outline-none focus:ring-2 focus:ring-blue-light focus:ring-offset-2:ring-offset-gray-900 transition-colors">
            {{ __('Create Account') }}
        </button>
    </form>

    <!-- Divider -->
    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">{{ __('Or') }}</span>
        </div>
    </div>

    <!-- Login Link -->
    <div class="text-center">
        <p class="text-sm text-gray-600">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" class="text-blue-primary hover:text-blue-primary:text-emerald-300 font-medium transition-colors">
                {{ __('Sign in') }}
            </a>
        </p>
    </div>
</x-guest-layout>


