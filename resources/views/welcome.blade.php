<x-app-layout>
    <!-- Hero Section -->
    <div class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-indigo-900 dark:to-purple-900">
        
        <!-- Content -->
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32">
            <div class="text-center space-y-8">
                <!-- Main Heading -->
                <div class="space-y-4">
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold">
                        <span class="block text-gray-900 dark:text-white mb-2">{{ __('Welcome to') }}</span>
                        <span class="block bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 bg-clip-text text-transparent">
                            Manaahel Platform
                        </span>
                    </h1>
                    <p class="text-xl sm:text-2xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                        {{ __('Your gateway to learning and community') }}
                    </p>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-8">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-700 hover:to-purple-700 transition-colors duration-200 shadow-lg">
                        {{ __('Get Started') }}
                    </a>
                    <a href="#vision" class="px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 transition-colors duration-200">
                        {{ __('Learn More') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Vision & Mission Section -->
    <div id="vision" class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Our Vision & Mission') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('Building a global community of learners and innovators') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Vision -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 p-8 rounded-2xl border border-indigo-200 dark:border-indigo-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Vision') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ __('To be the leading platform that empowers individuals worldwide through accessible education, fostering innovation, and building a connected community of lifelong learners.') }}
                    </p>
                </div>

                <!-- Mission -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 p-8 rounded-2xl border border-purple-200 dark:border-purple-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Mission') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                        {{ __('We provide high-quality educational programs, facilitate meaningful connections among members, and create opportunities for personal and professional growth through innovative learning experiences.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Programs Section -->
    @if($featuredPrograms->count() > 0)
    <div class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Featured Programs') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('Explore our most popular learning opportunities') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredPrograms as $program)
                <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all duration-200 group">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $program->type === 'academy' ? 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-300' : 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300' }}">
                                {{ ucfirst($program->type) }}
                            </span>
                            @if($program->fees > 0)
                            <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">${{ number_format($program->fees, 2) }}</span>
                            @else
                            <span class="text-2xl font-bold text-green-600 dark:text-green-400">{{ __('Free') }}</span>
                            @endif
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $program->getTranslation('name', app()->getLocale()) }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 line-clamp-3">
                            {{ $program->getTranslation('description', app()->getLocale()) }}
                        </p>
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-6">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ __('Starts') }}: {{ $program->start_date->format('M d, Y') }}
                        </div>
                        <a href="{{ route('programs.show', $program->slug) }}" class="block w-full text-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-colors duration-200">
                            {{ __('Learn More') }}
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('programs.index') }}" class="inline-flex items-center px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 transition-colors duration-200">
                    {{ __('View All Programs') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Achievements Section -->
    @if($featuredArticles->count() > 0)
    <div class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Recent Achievements') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('Celebrating our community successes') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($featuredArticles as $article)
                <div class="bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-xl transition-all duration-200 group">
                    <div class="p-8">
                        <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-lg flex items-center justify-center mb-6">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                            {{ $article->getTranslation('title', app()->getLocale()) }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-6 line-clamp-3">
                            {{ Str::limit($article->getTranslation('content', app()->getLocale()), 120) }}
                        </p>
                        <a href="{{ route('articles.show', $article->slug) }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-700 dark:hover:text-indigo-300 transition-colors">
                            {{ __('Read More') }}
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('articles.index') }}" class="inline-flex items-center px-8 py-4 bg-white dark:bg-gray-800 text-gray-900 dark:text-white font-semibold rounded-xl border-2 border-gray-200 dark:border-gray-700 hover:border-indigo-500 dark:hover:border-indigo-500 transition-colors duration-200">
                    {{ __('View All Articles') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
