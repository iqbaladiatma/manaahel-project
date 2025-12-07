<x-app-layout>
    <div class="py-12 mt-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('articles.index') }}" 
                   class="inline-flex items-center text-blue-primary dark:text-gold hover:text-blue-primary dark:text-gold:text-emerald-300 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Articles') }}
                </a>
            </div>

            <article class="bg-white dark:bg-dark-card rounded-lg border border-gray-200 dark:border-dark-border overflow-hidden">
                <!-- Featured Image -->
                @if($article->image_url)
                <div class="aspect-video w-full">
                    <img src="{{ $article->image_url }}" 
                         alt="{{ $article->title }}"
                         class="w-full h-full object-cover">
                </div>
                @endif

                <div class="p-8">
                    <!-- Meta -->
                    <div class="flex items-center gap-3 mb-6">
                        <span class="text-sm text-gray-500 dark:text-gray-500">
                            {{ $article->created_at->format('d F Y') }}
                        </span>
                        @if($article->category)
                        <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-50 dark:bg-blue-dark/20 text-blue-primary dark:text-gold">
                            {{ $article->category->name }}
                        </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-6">
                        {{ $article->title }}
                    </h1>

                    <!-- Content -->
                    <div class="prose prose-lg max-w-none">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
            </article>
        </div>
    </div>
</x-app-layout>


