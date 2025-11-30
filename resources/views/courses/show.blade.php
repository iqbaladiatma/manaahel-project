<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $course->getTranslation('title', app()->getLocale()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Program Badge (if associated) -->
                    @if($course->program)
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                {{ $course->program->getTranslation('name', app()->getLocale()) }}
                            </span>
                        </div>
                    @endif

                    <!-- Video Player -->
                    @if($course->getEmbedUrl())
                        <div class="mb-6">
                            <div class="aspect-video bg-gray-900 rounded-lg overflow-hidden">
                                @if(str_contains($course->getEmbedUrl(), 'youtube.com'))
                                    <!-- YouTube Embed -->
                                    <iframe 
                                        class="w-full h-full"
                                        src="{{ $course->getEmbedUrl() }}" 
                                        frameborder="0" 
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen>
                                    </iframe>
                                @else
                                    <!-- Self-hosted Video -->
                                    <video 
                                        class="w-full h-full"
                                        controls>
                                        <source src="{{ $course->getEmbedUrl() }}" type="video/mp4">
                                        {{ __('Your browser does not support the video tag.') }}
                                    </video>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Course Content -->
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-4">{{ __('Course Content') }}</h3>
                        <div class="prose dark:prose-invert max-w-none">
                            {!! nl2br(e($course->getTranslation('content', app()->getLocale()))) !!}
                        </div>
                    </div>

                    <!-- Back Button -->
                    <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('courses.index') }}" 
                           class="inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            ← {{ __('Back to Courses') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
