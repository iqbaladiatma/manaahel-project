<x-app-layout>
    <div class="py-12 mt-20">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('courses.index') }}" 
                   class="inline-flex items-center text-blue-primary hover:text-blue-600 transition-colors font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Courses') }}
                </a>
            </div>

            <!-- Course Header -->
            <div class="bg-white rounded-2xl shadow-xl border-2 border-gray-100 overflow-hidden mb-8">
                <div class="gradient-blue p-8 relative overflow-hidden">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -ml-24 -mb-24"></div>
                    
                    <div class="relative z-10">
                        <!-- Program Badge -->
                        <div class="mb-4">
                            <a href="{{ route('programs.show', $course->program->slug) }}" 
                               class="inline-flex items-center px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-semibold rounded-full hover:bg-white/30 transition">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                </svg>
                                {{ $course->program->getTranslation('name', app()->getLocale()) }}
                            </a>
                        </div>

                        <!-- Course Title -->
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                            {{ $course->getTranslation('title', app()->getLocale()) }}
                        </h1>

                        <!-- Course Meta -->
                        <div class="flex flex-wrap gap-4 text-white/90">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Order') }}: {{ $course->order }}
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Published') }}: {{ $course->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Description -->
                <div class="p-8 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        {{ __('Description') }}
                    </h2>
                    <div class="prose prose-lg max-w-none text-gray-600">
                        {{ $course->getTranslation('description', app()->getLocale()) }}
                    </div>
                </div>

                <!-- Course Content -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-blue-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                        {{ __('Course Modules') }}
                    </h2>
                    
                    <div class="space-y-4">
                        @foreach($course->modules as $module)
                            <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-100 hover:border-blue-200 transition-colors">
                                <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-primary font-bold mr-4">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold text-gray-900">
                                        {{ $module->getTranslation('title', app()->getLocale()) }}
                                    </h4>
                                    <p class="text-sm text-gray-500">
                                        {{ $module->duration_minutes }} {{ __('minutes') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                        
                        @if($course->modules->count() === 0)
                            <p class="text-gray-500 italic">{{ __('No modules available yet.') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Related Courses -->
            @if($relatedCourses->count() > 0)
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">
                        {{ __('Related Courses') }}
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedCourses as $related)
                            <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden hover:border-blue-primary hover:shadow-xl transition-all duration-300 group">
                                <div class="gradient-blue p-4">
                                    <h3 class="text-lg font-bold text-white line-clamp-2">
                                        {{ $related->getTranslation('title', app()->getLocale()) }}
                                    </h3>
                                </div>
                                <div class="p-4">
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                        {{ $related->getTranslation('description', app()->getLocale()) }}
                                    </p>
                                    <a href="{{ route('courses.show', $related) }}" 
                                       class="inline-flex items-center text-blue-primary font-semibold text-sm hover:gap-2 transition-all">
                                        {{ __('View Course') }}
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-blue-primary to-blue-600 rounded-2xl p-8 text-center shadow-xl">
                <h3 class="text-2xl font-bold text-white mb-4">
                    {{ __('Ready to Start Learning?') }}
                </h3>
                <p class="text-blue-50 mb-6 max-w-2xl mx-auto">
                    {{ __('Enroll in the program to access this course and many more') }}
                </p>
                <a href="{{ route('programs.show', $course->program->slug) }}" 
                   class="inline-flex items-center px-8 py-4 bg-white text-blue-primary font-bold rounded-full hover:bg-gold hover:text-white transition-all duration-300 transform hover:scale-105 shadow-lg">
                    {{ __('View Program Details') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
