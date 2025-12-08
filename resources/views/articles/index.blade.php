<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-50 to-white dark:from-dark-card dark:to-dark-bg pt-24 sm:pt-28 md:pt-32 pb-8 sm:pb-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 dark:text-gray-100 mb-3 sm:mb-4 animate-fade-in">
                {{ __('Blog') }}
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 dark:text-gray-400 animate-slide-up">
                {{ __('Read the latest articles from our community') }}
            </p>
        </div>
    </div>

    <div class="pb-12 sm:pb-16 bg-gray-50 dark:bg-dark-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Category Filter -->
            <div class="mb-8 sm:mb-10 flex justify-center">
                <form method="GET" action="{{ route('articles.index') }}" class="inline-flex flex-col sm:flex-row items-center gap-2 sm:gap-3 bg-white dark:bg-dark-card px-4 sm:px-6 py-3 sm:py-4 rounded-xl sm:rounded-2xl shadow-lg dark:shadow-dark-border border-2 border-gray-100 dark:border-dark-border w-full sm:w-auto">
                    <label for="category" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        {{ __('Category:') }}
                    </label>
                    <select name="category" id="category" 
                            class="rounded-xl border-2 border-gray-200 dark:border-dark-border bg-white dark:bg-dark-card text-gray-900 dark:text-gray-100 focus:border-blue-primary dark:focus:border-gold focus:ring-2 focus:ring-blue-100 dark:focus:ring-gold/20 transition-all"
                            onchange="this.form.submit()">
                        <option value="">{{ __('All Categories') }}</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            @if($articles->isEmpty())
                <div class="bg-white dark:bg-dark-card rounded-2xl border-2 border-gray-100 dark:border-dark-border p-12 text-center shadow-lg dark:shadow-dark-border">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-dark-card rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">{{ __('No articles available') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('Check back later for new content') }}</p>
                </div>
            @else
                <!-- Grid 3 Columns -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                    @foreach($articles as $article)
                        <a href="{{ route('articles.show', $article->slug) }}" class="group bg-white dark:bg-dark-card rounded-xl sm:rounded-2xl border-2 border-gray-100 dark:border-dark-border overflow-hidden hover:border-blue-primary dark:hover:border-gold hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:-translate-y-2 flex flex-col">
                            <!-- Article Image -->
                            @if($article->image_url)
                            <div class="h-48 sm:h-56 overflow-hidden bg-gray-100 dark:bg-dark-bg">
                                <img src="{{ $article->image_url }}" 
                                     alt="{{ $article->title }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            @else
                            <div class="h-48 sm:h-56 gradient-blue flex items-center justify-center">
                                <svg class="w-16 h-16 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            @endif

                            <!-- Article Content -->
                            <div class="p-6 flex-1 flex flex-col">
                                <!-- Meta Info -->
                                <div class="flex items-center gap-3 mb-4">
                                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-500">
                                        <svg class="w-4 h-4 mr-1.5 text-blue-primary dark:text-gold" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $article->created_at->format('d M Y') }}
                                    </div>
                                    @if($article->category)
                                    <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-primary dark:text-gold">
                                        {{ $article->category->name }}
                                    </span>
                                    @endif
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 group-hover:gradient-blue-text transition-all line-clamp-2">
                                    {{ $article->title }}
                                </h3>

                                <!-- Excerpt -->
                                <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-4 line-clamp-3 flex-1">
                                    {{ Str::limit(strip_tags($article->content), 150) }}
                                </p>

                                <!-- Read More Link -->
                                <div class="flex items-center text-blue-primary dark:text-gold font-semibold text-sm group-hover:gap-2 transition-all mt-auto">
                                    {{ __('Read More') }}
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>


