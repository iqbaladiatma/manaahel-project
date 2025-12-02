<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-indigo-900 dark:to-purple-900 py-20 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('Programs') }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                {{ __('Explore our Academy and Competition programs designed to enhance your skills') }}
            </p>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($programs->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">{{ __('No programs available at the moment.') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($programs as $program)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                    <h3 class="text-xl font-bold mb-2">
                                        {{ $program->getTranslation('name', app()->getLocale()) }}
                                    </h3>
                                    
                                    <div class="mb-3">
                                        <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full
                                            {{ $program->type === 'academy' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' }}">
                                            {{ ucfirst($program->type) }}
                                        </span>
                                    </div>

                                    @if(!$program->status)
                                        <div class="mb-3">
                                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                {{ __('Registration Closed') }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="mb-4">
                                        <p class="text-gray-600 dark:text-gray-400 line-clamp-3">
                                            {{ Str::limit($program->getTranslation('description', app()->getLocale()), 150) }}
                                        </p>
                                    </div>

                                    <a href="{{ route('programs.show', $program->slug) }}" 
                                       class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                        {{ __('View Details') }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
