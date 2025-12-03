<x-app-layout>
    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-indigo-900 dark:to-purple-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-5xl sm:text-6xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('About Manaahel') }}
                </h1>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    {{ __('Empowering learners worldwide through education, innovation, and community') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-6">{{ __('Our Story') }}</h2>
                    <div class="space-y-4 text-gray-600 dark:text-gray-300 leading-relaxed">
                        <p>
                            {{ __('Manaahel Platform was founded with a vision to democratize education and create a global community of learners. We believe that quality education should be accessible to everyone, regardless of their location or background.') }}
                        </p>
                        <p>
                            {{ __('Our platform brings together students, educators, and professionals from around the world, fostering collaboration, innovation, and lifelong learning. Through our comprehensive programs and supportive community, we help individuals achieve their personal and professional goals.') }}
                        </p>
                        <p>
                            {{ __('Today, Manaahel serves thousands of members across multiple countries, offering diverse programs in technology, business, and personal development. We continue to grow and evolve, always staying true to our mission of empowering learners worldwide.') }}
                        </p>
                    </div>
                </div>
                <div class="relative">
                    <div class="aspect-w-16 aspect-h-12 rounded-2xl overflow-hidden shadow-2xl">
                        <img src="https://picsum.photos/800/600?random=10" alt="{{ __('About Manaahel') }}" class="object-cover w-full h-full">
                    </div>
                    <div class="absolute -bottom-6 -right-6 w-48 h-48 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl opacity-20 blur-3xl"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="py-24 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Our Values') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('The principles that guide everything we do') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Excellence -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-200">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ __('Excellence') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('We strive for the highest quality in everything we deliver') }}</p>
                </div>

                <!-- Innovation -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-200">
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ __('Innovation') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('We embrace new ideas and technologies to enhance learning') }}</p>
                </div>

                <!-- Community -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-200">
                    <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ __('Community') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('We foster connections and collaboration among our members') }}</p>
                </div>

                <!-- Integrity -->
                <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl border border-gray-200 dark:border-gray-700 hover:shadow-xl transition-all duration-200">
                    <div class="w-14 h-14 bg-gradient-to-br from-indigo-600 to-purple-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">{{ __('Integrity') }}</h3>
                    <p class="text-gray-600 dark:text-gray-300">{{ __('We operate with transparency, honesty, and ethical standards') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- What We Offer Section -->
    <div class="py-24 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ __('What We Offer') }}</h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">{{ __('Comprehensive resources for your learning journey') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Academy Programs -->
                <div class="bg-gradient-to-br from-indigo-50 to-purple-50 dark:from-indigo-900/20 dark:to-purple-900/20 p-8 rounded-2xl border border-indigo-200 dark:border-indigo-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Academy Programs') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">{{ __('Structured learning paths with expert instructors, hands-on projects, and industry-recognized certifications.') }}</p>
                    <a href="{{ route('programs.index') }}" class="inline-flex items-center text-indigo-600 dark:text-indigo-400 font-semibold hover:text-indigo-700 dark:hover:text-indigo-300">
                        {{ __('Explore Programs') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Competitions -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 p-8 rounded-2xl border border-purple-200 dark:border-purple-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Competitions') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">{{ __('Challenge yourself in global competitions, showcase your skills, and win exciting prizes.') }}</p>
                    <a href="{{ route('programs.index') }}" class="inline-flex items-center text-purple-600 dark:text-purple-400 font-semibold hover:text-purple-700 dark:hover:text-purple-300">
                        {{ __('View Competitions') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Community Network -->
                <div class="bg-gradient-to-br from-pink-50 to-indigo-50 dark:from-pink-900/20 dark:to-indigo-900/20 p-8 rounded-2xl border border-pink-200 dark:border-pink-800">
                    <div class="w-16 h-16 bg-gradient-to-br from-pink-500 to-indigo-600 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">{{ __('Community Network') }}</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-6">{{ __('Connect with members worldwide, share experiences, and build lasting professional relationships.') }}</p>
                    <a href="{{ route('map.index') }}" class="inline-flex items-center text-pink-600 dark:text-pink-400 font-semibold hover:text-pink-700 dark:hover:text-pink-300">
                        {{ __('View Community Map') }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="py-24 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-600">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">{{ __('Ready to Start Your Journey?') }}</h2>
            <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
                {{ __('Join thousands of learners worldwide and unlock your potential with Manaahel Platform') }}
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white text-indigo-600 font-semibold rounded-xl hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                    {{ __('Join Now') }}
                </a>
                <a href="{{ route('programs.index') }}" class="px-8 py-4 bg-transparent text-white font-semibold rounded-xl border-2 border-white hover:bg-white hover:text-indigo-600 transition-colors duration-200">
                    {{ __('Browse Programs') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
