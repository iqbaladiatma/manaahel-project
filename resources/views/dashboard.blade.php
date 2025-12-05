<x-app-layout>
    <!-- Hero Section with Gradient -->
    <div class="relative bg-gradient-to-br from-white via-blue-50 to-amber-50 pt-24 pb-16 overflow-hidden mt-16">
        <!-- Decorative Blur Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Welcome Header -->
            <div class="text-center mb-12">
                <!-- Arabic Greeting -->
                <div class="mb-4">
                    <p class="text-3xl text-blue-600 font-bold" style="font-family: 'Times New Roman', serif; direction: rtl;">
                        السَّلاَمُ عَلَيْكُمْ وَرَحْمَةُ اللهِ وَبَرَكَاتُهُ
                    </p>
                </div>
                <h1 class="text-5xl md:text-6xl font-bold mb-4 bg-gradient-to-r from-blue-600 via-blue-700 to-amber-600 bg-clip-text text-transparent">
                    {{ __('Welcome back, :name!', ['name' => Auth::user()->name]) }}
                </h1>
                <p class="text-xl text-gray-600">
                    {{ __('Your Learning Dashboard') }}
                </p>
            </div>

            <!-- Stats Overview -->
            @php
                $enrolledPrograms = Auth::user()->registrations()->where('status', 'approved')->with('program')->get();
                $totalCourses = $enrolledPrograms->sum(function($reg) {
                    return $reg->program->courses()->where('is_published', true)->count();
                });
                $completedModules = Auth::user()->moduleProgress()->where('is_completed', true)->count();
                $totalModules = 0;
                foreach($enrolledPrograms as $reg) {
                    foreach($reg->program->courses as $course) {
                        $totalModules += $course->modules()->where('is_published', true)->count();
                    }
                }
                $progressPercentage = $totalModules > 0 ? round(($completedModules / $totalModules) * 100) : 0;
            @endphp

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                <!-- Stat 1: Programs -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-500/10 to-amber-500/10 rounded-full blur-2xl group-hover:from-blue-500/20 group-hover:to-amber-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-1">{{ $enrolledPrograms->count() }}</div>
                        <div class="text-sm text-gray-600 font-medium">{{ __('Programs') }}</div>
                    </div>
                </div>

                <!-- Stat 2: Courses -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-amber-500/10 to-blue-500/10 rounded-full blur-2xl group-hover:from-amber-500/20 group-hover:to-blue-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-1">{{ $totalCourses }}</div>
                        <div class="text-sm text-gray-600 font-medium">{{ __('Courses') }}</div>
                    </div>
                </div>

                <!-- Stat 3: Progress -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-green-500/10 to-emerald-500/10 rounded-full blur-2xl group-hover:from-green-500/20 group-hover:to-emerald-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-500 rounded-xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-1">{{ $progressPercentage }}%</div>
                        <div class="text-sm text-gray-600 font-medium">{{ __('Progress') }}</div>
                    </div>
                </div>

                <!-- Stat 4: Days Active -->
                <div class="group relative bg-white rounded-2xl p-6 shadow-lg border border-gray-200 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-500/10 to-purple-500/10 rounded-full blur-2xl group-hover:from-blue-500/20 group-hover:to-purple-500/20 transition-all"></div>
                    <div class="relative">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mb-3 shadow-md">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-gray-900 mb-1">{{ Auth::user()->created_at->diffInDays(now()) }}</div>
                        <div class="text-sm text-gray-600 font-medium">{{ __('Days Active') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
            
            <!-- My Enrolled Programs -->
            @if($enrolledPrograms->count() > 0)
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('My Enrolled Programs') }}</h2>
                            <p class="text-gray-600">{{ __('Continue your learning journey') }}</p>
                        </div>
                        <a href="{{ route('enrolled.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all">
                            {{ __('View All') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($enrolledPrograms->take(3) as $registration)
                            @php $program = $registration->program; @endphp
                            <div class="group relative bg-white rounded-2xl border border-gray-200 overflow-hidden hover:border-blue-500 transition-all duration-300 shadow-lg hover:shadow-2xl">
                                <!-- Glow Effect -->
                                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-amber-500/10 rounded-full blur-3xl group-hover:from-blue-500/20 group-hover:to-amber-500/20 transition-all"></div>
                                
                                <!-- Program Header -->
                                <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold rounded-full">
                                            {{ ucfirst($program->type) }}
                                        </span>
                                        <span class="px-3 py-1 bg-green-500 text-white text-xs font-semibold rounded-full">
                                            ✓ {{ __('Enrolled') }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-white line-clamp-2">
                                        {{ $program->getTranslation('name', app()->getLocale()) }}
                                    </h3>
                                </div>

                                <!-- Program Content -->
                                <div class="relative p-6">
                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        {{ Str::limit($program->getTranslation('description', app()->getLocale()), 100) }}
                                    </p>

                                    <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100">
                                        <div class="flex items-center text-sm text-gray-600">
                                            <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                            </svg>
                                            {{ $program->courses()->where('is_published', true)->count() }} {{ __('Courses') }}
                                        </div>
                                    </div>

                                    <a href="{{ route('enrolled.show', $program->slug) }}" 
                                       class="block w-full text-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:shadow-lg transition-all">
                                        {{ __('Continue Learning') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('Quick Actions') }}</h2>
                    <p class="text-gray-600">{{ __('Explore and manage your account') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Browse Programs -->
                    <a href="{{ route('programs.index') }}" class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:border-amber-500 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 rounded-full blur-2xl group-hover:from-amber-500/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-amber-600 transition-colors">{{ __('Browse Programs') }}</h3>
                            <p class="text-gray-600">{{ __('Explore available learning programs') }}</p>
                        </div>
                    </a>

                    <!-- My Profile -->
                    <a href="{{ route('profile.show') }}" class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:border-blue-500 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 rounded-full blur-2xl group-hover:from-blue-500/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">{{ __('My Profile') }}</h3>
                            <p class="text-gray-600">{{ __('View and edit your profile') }}</p>
                        </div>
                    </a>

                    <!-- Articles -->
                    <a href="{{ route('articles.index') }}" class="group relative bg-white rounded-2xl border border-gray-200 p-8 hover:border-green-500 hover:shadow-2xl transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 rounded-full blur-2xl group-hover:from-green-500/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mb-4 shadow-lg group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-green-600 transition-colors">{{ __('Articles') }}</h3>
                            <p class="text-gray-600">{{ __('Read latest articles and news') }}</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Empty State for No Programs -->
            @if($enrolledPrograms->count() === 0)
                <div class="relative bg-gradient-to-br from-blue-50 to-amber-50 rounded-2xl p-16 text-center overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>
                    
                    <div class="relative">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 mb-4">{{ __('Start Your Learning Journey') }}</h3>
                        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">{{ __('Explore our programs and enroll to begin your educational adventure') }}</p>
                        <a href="{{ route('programs.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:shadow-2xl transition-all transform hover:-translate-y-1">
                            {{ __('Browse Programs') }}
                            <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
