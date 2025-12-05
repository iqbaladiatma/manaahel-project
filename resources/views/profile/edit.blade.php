<x-app-layout>
    <div class="py-12 mt-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ __('Edit Profile') }}</h1>
                        <p class="text-gray-600 mt-2">{{ __('Update your account information and preferences') }}</p>
                    </div>
                    <a href="{{ route('profile.show') }}" class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 font-semibold rounded-lg hover:bg-gray-200 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        {{ __('Back to Profile') }}
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Quick Info -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden sticky top-24">
                        <!-- Header with gradient -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-center">
                            <div class="mx-auto w-20 h-20 rounded-full bg-white/20 backdrop-blur-sm border-4 border-white/30 flex items-center justify-center overflow-hidden mb-3">
                                @if(auth()->user()->avatar_url)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_url) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                                @else
                                    <span class="text-3xl font-bold text-white">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <h3 class="text-lg font-bold text-white">{{ auth()->user()->name }}</h3>
                            <p class="text-blue-100 text-sm mt-1">{{ auth()->user()->email }}</p>
                        </div>

                        <!-- Quick Stats -->
                        <div class="p-6">
                            <h4 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">{{ __('Quick Info') }}</h4>
                            <div class="space-y-3">
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-600">{{ ucfirst(auth()->user()->role) }}</span>
                                </div>
                                <div class="flex items-center text-sm">
                                    <svg class="w-5 h-5 text-gray-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-gray-600">{{ __('Joined') }} {{ auth()->user()->created_at->format('M Y') }}</span>
                                </div>
                                @if(auth()->user()->email_verified_at)
                                    <div class="flex items-center text-sm">
                                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-green-600 font-semibold">{{ __('Email Verified') }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Forms -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Profile Information -->
                    <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-blue-100">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Profile Information') }}
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">{{ __("Update your account's profile information and email address.") }}</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Update Password -->
                    <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-indigo-50 to-purple-50 px-6 py-4 border-b border-indigo-100">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Update Password') }}
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="bg-white rounded-xl shadow-lg border-2 border-red-100 overflow-hidden">
                        <div class="bg-gradient-to-r from-red-50 to-pink-50 px-6 py-4 border-b border-red-100">
                            <h2 class="text-xl font-bold text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Delete Account') }}
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">{{ __('Permanently delete your account.') }}</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
