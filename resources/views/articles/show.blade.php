<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $article->getTranslation('title', app()->getLocale()) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Article Title -->
                    <h1 class="text-3xl font-bold mb-6">
                        {{ $article->getTranslation('title', app()->getLocale()) }}
                    </h1>

                    <!-- Category and Metadata -->
                    <div class="mb-6 flex items-center gap-4 text-sm text-gray-600 dark:text-gray-400">
                        @if($article->category)
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                {{ $article->category->getTranslation('name', app()->getLocale()) }}
                            </span>
                        @endif
                        
                        <span>
                            {{ $article->created_at->format('d F Y') }}
                        </span>

                        @if($article->is_featured)
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                {{ __('Featured') }}
                            </span>
                        @endif
                    </div>

                    <!-- Article Content -->
                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($article->getTranslation('content', app()->getLocale()))) !!}
                    </div>

                    <!-- Back Button -->
                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('articles.index') }}" 
                           class="inline-block text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                            ← {{ __('Back to Blog') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
