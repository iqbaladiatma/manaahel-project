<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Category Filter -->
            <div class="mb-6">
                <form method="GET" action="{{ route('articles.index') }}" class="flex items-center gap-4">
                    <label for="category" class="text-gray-700 dark:text-gray-300 font-medium">
                        {{ __('Filter by Category:') }}
                    </label>
                    <select name="category" id="category" 
                            class="rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500"
                            onchange="this.form.submit()">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->getTranslation('name', app()->getLocale()) }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($articles->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">{{ __('No articles available at the moment.') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($articles as $article)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-6 hover:shadow-lg transition-shadow">
                                    <h3 class="text-xl font-bold mb-2">
                                        {{ $article->getTranslation('title', app()->getLocale()) }}
                                    </h3>
                                    
                                    <!-- Category Badge -->
                                    @if($article->category)
                                        <div class="mb-3">
                                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                {{ $article->category->getTranslation('name', app()->getLocale()) }}
                                            </span>
                                        </div>
                                    @endif

                                    <!-- Article Excerpt -->
                                    <div class="mb-4">
                                        <p class="text-gray-600 dark:text-gray-400 line-clamp-3">
                                            {{ Str::limit(strip_tags($article->getTranslation('content', app()->getLocale())), 150) }}
                                        </p>
                                    </div>

                                    <a href="{{ route('articles.show', $article->slug) }}" 
                                       class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition-colors">
                                        {{ __('Read More') }}
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-6">
                            {{ $articles->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
