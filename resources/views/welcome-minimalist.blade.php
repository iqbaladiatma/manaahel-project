<x-app-layout>
    <!-- Hero Section - Minimalist -->
    <div class="bg-white dark:bg-dark-card pt-32 pb-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center space-y-6">
                <!-- Logo -->
                <div class="flex justify-center mb-8">
                    <div class="w-20 h-20 bg-blue-primary rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-3xl">M</span>
                    </div>
                </div>

                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-gray-100 leading-tight">
                    {{ __('Manaahel Batch 2024') }}
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    {{ __('Connecting Hearts, Building Dreams, Creating Impact') }}
                </p>

                <!-- Buttons -->
                <div class="flex flex-wrap gap-3 justify-center pt-6">
                    @auth
                    <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary transition-colors">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('members.index') }}" class="px-6 py-3 bg-gray-100 dark:bg-dark-card text-gray-900 dark:text-gray-100 font-medium rounded-lg hover:bg-gray-200:bg-gray-700 transition-colors">
                        {{ __('Members') }}
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary transition-colors">
                        {{ __('Login') }}
                    </a>
                    <a href="{{ route('register') }}" class="px-6 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800 transition-colors">
                        {{ __('Join Us') }}
                    </a>
                    @endauth
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12 max-w-3xl mx-auto">
                    <div class="bg-gray-50 dark:bg-dark-bg rounded-lg p-6 border border-gray-200 dark:border-dark-border">
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $totalMembers ?? 150 }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Members') }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-dark-bg rounded-lg p-6 border border-gray-200 dark:border-dark-border">
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $totalPrograms ?? 10 }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Programs') }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-dark-bg rounded-lg p-6 border border-gray-200 dark:border-dark-border">
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">25</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Achievements') }}</div>
                    </div>
                    <div class="bg-gray-50 dark:bg-dark-bg rounded-lg p-6 border border-gray-200 dark:border-dark-border">
                        <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-1">{{ $totalCities ?? 30 }}</div>
                        <div class="text-sm text-gray-600 dark:text-gray-400">{{ __('Cities') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest News -->
    <div class="py-16 bg-gray-50 dark:bg-dark-bg">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('Latest News') }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ __('Stay updated with our activities') }}</p>
            </div>

            @if(isset($featuredArticles) && $featuredArticles->count() > 0)
            <div class="space-y-6">
                @foreach($featuredArticles->take(3) as $article)
                <a href="{{ route('articles.show', $article->slug) }}" class="block bg-white dark:bg-dark-card rounded-lg border border-gray-200 dark:border-dark-border overflow-hidden hover:border-blue-light transition-colors group">
                    <div class="flex flex-col sm:flex-row">
                        @if($article->image_url)
                        <div class="sm:w-48 h-48 sm:h-auto flex-shrink-0">
                            <img src="{{ $article->image_url }}" 
                                 alt="{{ $article->title }}"
                                 class="w-full h-full object-cover">
                        </div>
                        @endif
                        <div class="p-6 flex-1">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="text-sm text-gray-500 dark:text-gray-500">{{ $article->created_at->format('d M Y') }}</span>
                                @if($article->category)
                                <span class="px-2 py-1 text-xs font-medium rounded bg-blue-50 dark:bg-blue-dark/20 text-blue-primary dark:text-gold">
                                    {{ $article->category->name }}
                                </span>
                                @endif
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-blue-primary dark:text-gold transition-colors">
                                {{ $article->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 line-clamp-2">
                                {{ Str::limit($article->content, 150) }}
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

            <div class="text-center mt-8">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary transition-colors">
                    {{ __('View All News') }}
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Programs -->
    <div class="py-16 bg-white dark:bg-dark-card">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('Our Programs') }}</h2>
                <p class="text-gray-600 dark:text-gray-400">{{ __('Join our exclusive programs') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gray-50 dark:bg-dark-bg rounded-lg p-8 border border-gray-200 dark:border-dark-border hover:border-blue-light transition-colors">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-primary dark:text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3">{{ __('Manaahel Academy') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('Enhance your skills with comprehensive learning programs.') }}</p>
                    <a href="{{ route('programs.index', ['type' => 'academy']) }}" class="inline-flex items-center text-blue-primary dark:text-gold font-medium hover:text-blue-primary dark:text-gold">
                        {{ __('Explore') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="bg-gray-50 dark:bg-dark-bg rounded-lg p-8 border border-gray-200 dark:border-dark-border hover:border-blue-light transition-colors">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-blue-primary dark:text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3">{{ __('Manaahel Competition') }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">{{ __('Showcase your talents in various challenges.') }}</p>
                    <a href="{{ route('programs.index', ['type' => 'competition']) }}" class="inline-flex items-center text-blue-primary dark:text-gold font-medium hover:text-blue-primary dark:text-gold">
                        {{ __('View') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="py-16 bg-blue-primary">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">{{ __('Ready to Join?') }}</h2>
            <p class="text-blue-100 mb-8 max-w-2xl mx-auto">
                {{ __('Join thousands of learners worldwide and unlock your potential') }}
            </p>
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-3 bg-white dark:bg-dark-card text-blue-primary dark:text-gold font-medium rounded-lg hover:bg-gray-100 dark:bg-dark-card dark:hover:bg-dark-card transition-colors">
                    {{ __('Join Now') }}
                </a>
                <a href="{{ route('programs.index') }}" class="px-8 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-800 transition-colors">
                    {{ __('Browse Programs') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>


