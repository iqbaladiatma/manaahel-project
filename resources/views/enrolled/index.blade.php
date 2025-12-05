<x-app-layout>
    <!-- Hero Section with Gradient Background -->
    <div class="relative bg-gradient-to-br from-white via-blue-50 to-amber-50 py-24 mt-16 overflow-hidden">
        <!-- Decorative Blur Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-50 to-amber-50 border border-blue-200 rounded-full mb-6 shadow-sm">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                    </svg>
                    <span class="text-sm font-semibold text-blue-700">{{ __('Learning Dashboard') }}</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-blue-600 via-blue-700 to-amber-600 bg-clip-text text-transparent">
                    {{ __('My Enrolled Programs') }}
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    {{ __('Access your enrolled programs and continue learning') }}
                </p>
            </div>
        </div>
    </div>

    <div class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($enrolledPrograms->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($enrolledPrograms as $enrollment)
                        <div class="group relative bg-white rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-500 transition-all duration-300 shadow-lg hover:shadow-2xl">
                            <!-- Glow Effect -->
                            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-amber-500/10 rounded-full blur-3xl group-hover:from-blue-500/20 group-hover:to-amber-500/20 transition-all duration-300"></div>
                            
                            <!-- Program Header -->
                            <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                                <div class="flex items-center justify-between mb-3">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                        {{ ucfirst($enrollment->program->type) }}
                                    </span>
                                    @if($enrollment->program->delivery_type === 'online_zoom')
                                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center">
                                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-white line-clamp-2">
                                    {{ $enrollment->program->getTranslation('name', app()->getLocale()) }}
                                </h3>
                            </div>

                            <!-- Program Info -->
                            <div class="relative p-6">
                                <p class="text-gray-600 text-sm mb-6 line-clamp-2 leading-relaxed">
                                    {{ $enrollment->program->getTranslation('description', app()->getLocale()) }}
                                </p>

                                <div class="space-y-3 mb-6">
                                    @if($enrollment->program->delivery_type === 'online_course')
                                        <div class="flex items-center text-sm text-gray-600">
                                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                                                </svg>
                                            </div>
                                            <span class="font-medium">{{ $enrollment->program->courses->count() }} {{ __('Courses') }}</span>
                                        </div>
                                    @else
                                        <div class="flex items-center text-sm text-gray-600">
                                            <div class="w-8 h-8 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                                                <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <span class="font-medium">{{ $enrollment->program->schedules->count() }} {{ __('Sessions') }}</span>
                                        </div>
                                    @endif

                                    <div class="flex items-center text-sm text-gray-600">
                                        <div class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-4 h-4 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <span class="font-medium">{{ __('Enrolled') }}: {{ $enrollment->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>

                                <a href="{{ route('enrolled.show', $enrollment->program->slug) }}" 
                                   class="group/btn relative block w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl text-center transition-all duration-300 shadow-lg hover:shadow-xl overflow-hidden">
                                    <div class="absolute inset-0 bg-gradient-to-r from-blue-700 to-blue-800 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                                    <span class="relative flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ __('Continue Learning') }}
                                        <svg class="w-4 h-4 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="group relative bg-white rounded-2xl border border-gray-200 overflow-hidden p-12 text-center shadow-lg">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>
                    
                    <div class="relative">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ __('No Enrolled Programs Yet') }}</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">{{ __('You haven\'t enrolled in any programs yet. Browse available programs and start learning!') }}</p>
                        <a href="{{ route('programs.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:-translate-y-0.5">
                            {{ __('Browse Programs') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
