<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('E-Learning Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($courses->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">{{ __('No courses available at the moment.') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($courses as $course)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                    <h3 class="text-xl font-bold mb-4">
                                        {{ $course->getTranslation('title', app()->getLocale()) }}
                                    </h3>

                                    @if($course->program)
                                        <div class="mb-3">
                                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                {{ $course->program->getTranslation('name', app()->getLocale()) }}
                                            </span>
                                        </div>
                                    @endif

                                    <div class="mb-4">
                                        <p class="text-gray-600 dark:text-gray-400 line-clamp-3">
                                            {{ Str::limit(strip_tags($course->getTranslation('content', app()->getLocale())), 150) }}
                                        </p>
                                    </div>

                                    <a href="{{ route('courses.show', $course) }}" 
                                       class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                        {{ __('View Course') }}
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
