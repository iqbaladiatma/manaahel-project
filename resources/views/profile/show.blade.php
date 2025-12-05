<x-app-layout>
    <div class="py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Page Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">{{ __('My Profile') }}</h1>
                <p class="text-gray-600 mt-2">{{ __('View your account information and learning progress') }}</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column - Profile Info -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Profile Card -->
                    <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden">
                        <!-- Header with gradient -->
                        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 text-center relative">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                            
                            <div class="relative z-10">
                                <!-- Avatar -->
                                <div class="mx-auto w-24 h-24 rounded-full bg-white/20 backdrop-blur-sm border-4 border-white/30 flex items-center justify-center overflow-hidden mb-4">
                                    @if($user->avatar_url)
                                        <img src="{{ asset('storage/' . $user->avatar_url) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-4xl font-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                                    @endif
                                </div>

                                <!-- Name -->
                                <h2 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h2>
                                
                                <!-- Role Badge -->
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/20 backdrop-blur-sm text-white">
                                    @if($user->role === 'admin')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"/>
                                        </svg>
                                    @else
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                        </svg>
                                    @endif
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        </div>

                        <!-- Profile Details -->
                        <div class="p-6 space-y-4">
                            <!-- Email -->
                            <div>
                                <label class="text-xs text-gray-500 uppercase tracking-wide font-semibold">{{ __('Email') }}</label>
                                <p class="text-gray-900 font-medium mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                    </svg>
                                    {{ $user->email }}
                                </p>
                                @if($user->email_verified_at)
                                    <span class="inline-flex items-center text-xs text-green-600 mt-1">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ __('Verified') }}
                                    </span>
                                @endif
                            </div>

                            <!-- Phone -->
                            @if($user->phone)
                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wide font-semibold">{{ __('Phone') }}</label>
                                    <p class="text-gray-900 font-medium mt-1 flex items-center">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                        </svg>
                                        {{ $user->phone }}
                                    </p>
                                </div>
                            @endif

                            <!-- Member Since -->
                            <div>
                                <label class="text-xs text-gray-500 uppercase tracking-wide font-semibold">{{ __('Member Since') }}</label>
                                <p class="text-gray-900 font-medium mt-1 flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $user->created_at->format('d F Y') }}
                                </p>
                            </div>

                            <!-- Bio -->
                            @if($user->bio)
                                <div>
                                    <label class="text-xs text-gray-500 uppercase tracking-wide font-semibold">{{ __('Bio') }}</label>
                                    <p class="text-gray-700 mt-1 text-sm">{{ $user->bio }}</p>
                                </div>
                            @endif

                            <!-- Social Media Links -->
                            @if($user->instagram_url || $user->linkedin_url || $user->twitter_url || $user->facebook_url || $user->youtube_url || $user->tiktok_url)
                                <div class="pt-4 border-t border-gray-200">
                                    <label class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-3 block">{{ __('Social Media') }}</label>
                                    <div class="flex flex-wrap gap-2">
                                        @if($user->instagram_url)
                                            <a href="{{ $user->instagram_url }}" target="_blank" class="p-2 bg-pink-50 text-pink-600 rounded-lg hover:bg-pink-100 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                                            </a>
                                        @endif
                                        @if($user->linkedin_url)
                                            <a href="{{ $user->linkedin_url }}" target="_blank" class="p-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                            </a>
                                        @endif
                                        @if($user->facebook_url)
                                            <a href="{{ $user->facebook_url }}" target="_blank" class="p-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                            </a>
                                        @endif
                                        @if($user->youtube_url)
                                            <a href="{{ $user->youtube_url }}" target="_blank" class="p-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            <!-- Edit Profile Button -->
                            <div class="pt-4 border-t border-gray-200">
                                <a href="{{ route('profile.edit') }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    {{ __('Edit Profile') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Statistics & Activity -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Learning Statistics -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Enrolled Programs -->
                        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-lg p-6 text-white">
                            <div class="flex items-center justify-between mb-4">
                                <svg class="w-12 h-12 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                </svg>
                            </div>
                            <p class="text-blue-100 text-sm font-medium mb-1">{{ __('Enrolled Programs') }}</p>
                            <p class="text-4xl font-bold">{{ $totalEnrolled }}</p>
                        </div>

                        <!-- Total Modules -->
                        <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl shadow-lg p-6 text-white">
                            <div class="flex items-center justify-between mb-4">
                                <svg class="w-12 h-12 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                            </div>
                            <p class="text-indigo-100 text-sm font-medium mb-1">{{ __('Completed Modules') }}</p>
                            <p class="text-4xl font-bold">{{ $completedModules }}<span class="text-xl text-indigo-200">/{{ $totalModules }}</span></p>
                        </div>

                        <!-- Completion Rate -->
                        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-lg p-6 text-white">
                            <div class="flex items-center justify-between mb-4">
                                <svg class="w-12 h-12 text-white/30" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <p class="text-green-100 text-sm font-medium mb-1">{{ __('Completion Rate') }}</p>
                            <p class="text-4xl font-bold">{{ $completionPercentage }}%</p>
                        </div>
                    </div>

                    <!-- Enrolled Programs List -->
                    @if($enrolledPrograms->count() > 0)
                        <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-blue-100">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                    </svg>
                                    {{ __('My Programs') }}
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-4">
                                    @foreach($enrolledPrograms as $enrollment)
                                        @php
                                            $program = $enrollment->program;
                                            $programModules = 0;
                                            $programCompleted = 0;
                                            
                                            foreach($program->courses as $course) {
                                                $programModules += $course->modules->count();
                                                $programCompleted += \App\Models\UserModuleProgress::where('user_id', $user->id)
                                                    ->whereIn('course_module_id', $course->modules->pluck('id'))
                                                    ->where('is_completed', true)
                                                    ->count();
                                            }
                                            
                                            $programProgress = $programModules > 0 ? round(($programCompleted / $programModules) * 100) : 0;
                                        @endphp
                                        
                                        <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-blue-300 transition">
                                            <div class="flex items-start justify-between mb-3">
                                                <div class="flex-1">
                                                    <h4 class="font-bold text-gray-900 text-lg mb-1">{{ $program->getTranslation('name', app()->getLocale()) }}</h4>
                                                    <div class="flex items-center gap-3 text-sm text-gray-500">
                                                        <span class="flex items-center">
                                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                            </svg>
                                                            {{ __('Enrolled') }}: {{ $enrollment->created_at->format('d M Y') }}
                                                        </span>
                                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 text-xs font-semibold rounded">
                                                            {{ ucfirst($program->delivery_type) }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <a href="{{ route('enrolled.show', $program->slug) }}" class="ml-4 px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-lg hover:bg-blue-700 transition whitespace-nowrap">
                                                    {{ __('Continue') }}
                                                </a>
                                            </div>
                                            
                                            @if($program->delivery_type === 'online_course')
                                                <!-- Progress Bar -->
                                                <div>
                                                    <div class="flex items-center justify-between text-sm mb-2">
                                                        <span class="text-gray-600 font-medium">{{ __('Progress') }}</span>
                                                        <span class="text-gray-900 font-bold">{{ $programProgress }}%</span>
                                                    </div>
                                                    <div class="bg-gray-200 rounded-full h-2 overflow-hidden">
                                                        <div class="bg-gradient-to-r from-blue-500 to-indigo-500 h-full transition-all duration-300" style="width: {{ $programProgress }}%"></div>
                                                    </div>
                                                    <p class="text-xs text-gray-500 mt-1">{{ $programCompleted }} / {{ $programModules }} {{ __('modules completed') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Recent Activity -->
                    @if($recentActivity->count() > 0)
                        <div class="bg-white rounded-xl shadow-lg border-2 border-gray-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-4 border-b border-green-100">
                                <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Recent Activity') }}
                                </h3>
                            </div>
                            <div class="p-6">
                                <div class="space-y-3">
                                    @foreach($recentActivity as $activity)
                                        <div class="flex items-start border-l-4 border-green-500 pl-4 py-2">
                                            <div class="flex-shrink-0 mr-3">
                                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-semibold text-gray-900">{{ __('Completed') }}: {{ $activity->courseModule->getTranslation('title', app()->getLocale()) }}</p>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $activity->courseModule->course->getTranslation('title', app()->getLocale()) }}
                                                    • {{ $activity->courseModule->course->program->getTranslation('name', app()->getLocale()) }}
                                                </p>
                                                <p class="text-xs text-gray-400 mt-1">{{ $activity->completed_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
