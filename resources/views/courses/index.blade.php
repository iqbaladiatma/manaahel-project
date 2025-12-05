<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-blue-50 via-white to-gold/5 pt-32 pb-12 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-10 right-10 w-64 h-64 bg-blue-primary/5 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-10 w-80 h-80 bg-gold/5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <!-- Arabic Title -->
            <div class="mb-4 fade-in-up">
                <p class="text-3xl text-gold arabic-glow" style="font-family: 'Times New Roman', serif; direction: rtl;">
                    الدُّرُوسُ
                </p>
            </div>
            <h1 class="text-5xl font-bold text-gray-900 mb-4 animate-fade-in">
                {{ __('Courses') }}
            </h1>
            <div class="w-24 h-1 gradient-blue mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto animate-slide-up">
                {{ __('Explore our comprehensive course library') }}
            </p>
        </div>
    </div>

    <div class="pb-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search and Filter -->
            <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 p-8 mb-8 -mt-8 relative z-10">
                <form method="GET" action="{{ route('courses.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Search -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 mb-3">
                            {{ __('Search Courses') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   id="search" 
                                   value="{{ request('search') }}"
                                   placeholder="{{ __('Search by title or description...') }}"
                                   class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-blue-primary focus:ring-2 focus:ring-blue-100 transition-all">
                        </div>
                    </div>

                    <!-- Program Filter -->
                    <div>
                        <label for="program" class="block text-sm font-semibold text-gray-700 mb-3">
                            {{ __('Program') }}
                        </label>
                        <select name="program" 
                                id="program"
                                class="w-full py-3 rounded-xl border-2 border-gray-200 focus:border-blue-primary focus:ring-2 focus:ring-blue-100 transition-all">
                            <option value="">{{ __('All Programs') }}</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ request('program') == $program->id ? 'selected' : '' }}>
                                    {{ $program->getTranslation('name', app()->getLocale()) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="md:col-span-3 flex gap-3">
                        <button type="submit" 
                                class="px-8 py-3 gradient-blue text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            {{ __('Search') }}
                        </button>
                        @if(request('search') || request('program'))
                            <a href="{{ route('courses.index') }}" 
                               class="px-8 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300">
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Courses Grid -->
            @if($courses->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($courses as $course)
                        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 overflow-hidden hover:border-blue-primary hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                            <!-- Course Header -->
                            <div class="gradient-blue p-6 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                                <div class="relative z-10">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                            {{ $course->program->getTranslation('name', app()->getLocale()) }}
                                        </span>
                                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                            </svg>
                                        </div>
                                    </div>
                                    <h3 class="text-xl font-bold text-white mb-2 line-clamp-2">
                                        {{ $course->getTranslation('title', app()->getLocale()) }}
                                    </h3>
                                </div>
                            </div>

                            <!-- Course Content -->
                            <div class="p-6">
                                <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                    {{ $course->getTranslation('description', app()->getLocale()) }}
                                </p>

                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1 text-blue-primary" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Order') }}: {{ $course->order }}
                                    </div>
                                    <a href="{{ route('courses.show', $course) }}" 
                                       class="inline-flex items-center text-blue-primary font-semibold hover:gap-2 transition-all">
                                        {{ __('View Course') }}
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $courses->links() }}
                </div>
            @else
                <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ __('No Courses Found') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('Try adjusting your search or filter criteria') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
