<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $program->getTranslation('name', app()->getLocale()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Program Title -->
                    <h1 class="text-3xl font-bold mb-6">
                        {{ $program->getTranslation('name', app()->getLocale()) }}
                    </h1>

                    <!-- Program Type Badge -->
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                            {{ $program->type === 'academy' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                            {{ ucfirst($program->type) }}
                        </span>
                        
                        @if(!$program->status)
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200 ml-2">
                                {{ __('Registration Closed') }}
                            </span>
                        @endif
                    </div>

                    <!-- Program Description -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">{{ __('Description') }}</h3>
                        <div class="prose dark:prose-invert max-w-none">
                            {!! nl2br(e($program->getTranslation('description', app()->getLocale()))) !!}
                        </div>
                    </div>

                    <!-- Program Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Fees -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('Program Fees') }}</h4>
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($program->fees, 0, ',', '.') }}
                            </p>
                        </div>

                        <!-- Start Date -->
                        <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">{{ __('Start Date') }}</h4>
                            <p class="text-lg">
                                {{ $program->start_date->format('d F Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Registration Form/Button -->
                    @if($program->status)
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h3 class="text-lg font-semibold mb-4">{{ __('Register for this Program') }}</h3>
                            
                            @auth
                                <a href="{{ route('registrations.create', ['program' => $program->id]) }}" 
                                   class="inline-block px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md transition-colors">
                                    {{ __('Register Now') }}
                                </a>
                            @else
                                <div class="bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-800 rounded-lg p-4">
                                    <p class="text-yellow-800 dark:text-yellow-200 mb-3">
                                        {{ __('You need to be logged in to register for this program.') }}
                                    </p>
                                    <a href="{{ route('login') }}" 
                                       class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                        {{ __('Login') }}
                                    </a>
                                    <a href="{{ route('register') }}" 
                                       class="inline-block px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition-colors ml-2">
                                        {{ __('Register Account') }}
                                    </a>
                                </div>
                            @endauth
                        </div>
                    @else
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4">
                                <p class="text-red-800 dark:text-red-200 font-semibold">
                                    {{ __('Registration for this program is currently closed.') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-6">
                        <a href="{{ route('programs.index') }}" 
                           class="inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            ← {{ __('Back to Programs') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
