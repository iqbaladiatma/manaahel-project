<x-app-layout>
    <div class="py-12 mt-20 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-8">
                <a href="{{ route('enrolled.index') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-700 transition-colors font-semibold group">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to My Programs') }}
                </a>
            </div>

            <!-- Program Header -->
            <div class="group relative bg-gradient-to-br from-blue-600 via-blue-700 to-amber-600 rounded-2xl shadow-2xl p-10 mb-8 text-white overflow-hidden">
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -ml-24 -mb-24"></div>
                <div class="absolute top-1/2 right-1/4 w-40 h-40 bg-amber-500/10 rounded-full blur-2xl"></div>
                
                <div class="relative z-10">
                    <div class="flex flex-wrap items-center gap-3 mb-6">
                        <span class="px-4 py-2 bg-white/20 backdrop-blur-sm text-white text-sm font-semibold rounded-full shadow-lg">
                            {{ ucfirst($program->type) }}
                        </span>
                        <span class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 backdrop-blur-sm text-white text-sm font-semibold rounded-full flex items-center shadow-lg">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Enrolled') }}
                        </span>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">{{ $program->getTranslation('name', app()->getLocale()) }}</h1>
                    <p class="text-xl text-blue-50 max-w-4xl mb-8 leading-relaxed">{{ $program->getTranslation('description', app()->getLocale()) }}</p>

                    @if(isset($nextModule) && isset($nextCourse))
                        <div class="flex flex-wrap gap-4 items-center">
                            <a href="{{ route('enrolled.module.show', [$program->slug, $nextCourse->slug, $nextModule->id]) }}" 
                               class="group/btn relative inline-flex items-center px-8 py-4 bg-white text-blue-600 font-bold rounded-xl hover:bg-amber-50 transition-all duration-300 shadow-xl transform hover:-translate-y-1 overflow-hidden">
                                <div class="absolute inset-0 bg-gradient-to-r from-amber-50 to-blue-50 opacity-0 group-hover/btn:opacity-100 transition-opacity"></div>
                                <svg class="relative w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                                </svg>
                                <span class="relative">{{ __('Continue Learning') }}</span>
                            </a>
                            <div class="text-white text-base bg-white/10 backdrop-blur-sm px-4 py-3 rounded-xl">
                                <span class="opacity-90">{{ __('Next up:') }}</span>
                                <span class="font-bold ml-2">{{ $nextModule->getTranslation('title', app()->getLocale()) }}</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Syllabus (Shown first for Zoom/Academy, or if no courses) -->
                    @if($program->syllabus && ($program->delivery_type !== 'online_course' || $program->courses->count() === 0))
                        <div class="group relative bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                            <!-- Glow Effect -->
                            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-amber-500/10 to-blue-500/10 rounded-full blur-3xl group-hover:from-amber-500/20 group-hover:to-blue-500/20 transition-all"></div>
                            
                            <div class="relative bg-gradient-to-r from-amber-50 via-blue-50 to-amber-50 p-8 border-b border-amber-100">
                                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                        </svg>
                                    </div>
                                    {{ __('Course Syllabus') }}
                                </h2>
                            </div>
                            <div class="relative p-8">
                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($program->getTranslation('syllabus', app()->getLocale()))) !!}
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Course Modules (Online Course) - Prioritized for Online Course Type -->
                    @if($program->delivery_type === 'online_course' && $program->courses->count() > 0)
                        <div class="group relative bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                            <!-- Glow Effect -->
                            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-amber-500/10 rounded-full blur-3xl group-hover:from-blue-500/20 group-hover:to-amber-500/20 transition-all"></div>
                            
                            <div class="relative bg-gradient-to-r from-blue-50 via-blue-50 to-amber-50 p-8 border-b border-blue-100">
                                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                                        </svg>
                                    </div>
                                    {{ __('Course Modules') }}
                                </h2>
                            </div>
                            <div class="relative p-8 space-y-6">
                                @foreach($program->courses as $courseIndex => $course)
                                    <div class="group/course border-2 border-gray-200 rounded-xl overflow-hidden hover:border-blue-400 hover:shadow-lg transition-all duration-300">
                                        <div class="bg-gradient-to-r from-blue-50 to-amber-50 p-6">
                                            <h3 class="font-bold text-gray-900 text-xl flex items-center">
                                                <span class="bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-xl w-10 h-10 flex items-center justify-center text-base mr-4 flex-shrink-0 shadow-md">
                                                    {{ $courseIndex + 1 }}
                                                </span>
                                                {{ $course->getTranslation('title', app()->getLocale()) }}
                                            </h3>
                                            @if($course->description)
                                                <p class="text-gray-600 text-base mt-3 ml-14 leading-relaxed">{{ $course->getTranslation('description', app()->getLocale()) }}</p>
                                            @endif
                                        </div>
                                        @if($course->modules->count() > 0)
                                            <div class="divide-y divide-gray-200 bg-white">
                                                @foreach($course->modules as $moduleIndex => $module)
                                                    <a href="{{ route('enrolled.module.show', [$program->slug, $course->slug, $module->id]) }}" 
                                                       class="group/module flex items-center justify-between px-6 py-5 hover:bg-gradient-to-r hover:from-blue-50 hover:to-amber-50 transition-all duration-300">
                                                        <div class="flex items-center flex-1">
                                                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 group-hover/module:bg-blue-600 transition-colors">
                                                                <svg class="w-5 h-5 text-blue-600 group-hover/module:text-white transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                            <div class="flex-1">
                                                                <span class="text-gray-900 font-semibold text-base group-hover/module:text-blue-600 transition-colors">{{ $module->getTranslation('title', app()->getLocale()) }}</span>
                                                                @if($module->duration_minutes)
                                                                    <span class="text-sm text-gray-500 ml-3">• {{ $module->duration_minutes }} {{ __('min') }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <svg class="w-6 h-6 text-gray-400 group-hover/module:text-blue-600 group-hover/module:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                        </svg>
                                                    </a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Syllabus (Shown second for Online Course with modules) -->
                    @if($program->syllabus && $program->delivery_type === 'online_course' && $program->courses->count() > 0)
                        <div class="group relative bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                            <!-- Glow Effect -->
                            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-amber-500/10 to-blue-500/10 rounded-full blur-3xl group-hover:from-amber-500/20 group-hover:to-blue-500/20 transition-all"></div>
                            
                            <div class="relative bg-gradient-to-r from-amber-50 via-blue-50 to-amber-50 p-8 border-b border-amber-100">
                                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                        </svg>
                                    </div>
                                    {{ __('Course Syllabus') }}
                                </h2>
                            </div>
                            <div class="relative p-8">
                                <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed">
                                    {!! nl2br(e($program->getTranslation('syllabus', app()->getLocale()))) !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Program Schedules (Online Zoom) -->
                    @if($program->delivery_type === 'online_zoom' && $program->schedules->count() > 0)
                        <div class="group relative bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden hover:shadow-2xl transition-all duration-300">
                            <!-- Glow Effect -->
                            <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-green-500/10 rounded-full blur-3xl group-hover:from-blue-500/20 group-hover:to-green-500/20 transition-all"></div>
                            
                            <div class="relative bg-gradient-to-r from-blue-50 via-green-50 to-blue-50 p-8 border-b border-blue-100">
                                <h2 class="text-3xl font-bold text-gray-900 flex items-center">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-green-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    {{ __('Live Session Schedule') }}
                                </h2>
                            </div>
                            <div class="relative p-8 space-y-4">
                                @foreach($program->schedules as $schedule)
                                    @php
                                        $isPast = $schedule->scheduled_at->isPast();
                                        $isToday = $schedule->scheduled_at->isToday();
                                        $isFuture = $schedule->scheduled_at->isFuture();
                                        $hasAttended = isset($userAttendances[$schedule->id]);
                                    @endphp
                                    <div class="group/schedule flex items-start border-2 {{ $isPast ? 'border-gray-200 bg-gray-50' : ($isToday ? 'border-green-400 bg-gradient-to-r from-green-50 to-emerald-50' : 'border-blue-300 bg-gradient-to-r from-blue-50 to-indigo-50') }} rounded-xl p-6 transition-all duration-300 hover:shadow-lg">
                                        <div class="bg-gradient-to-br {{ $isPast ? 'from-gray-500 to-gray-600' : ($isToday ? 'from-green-500 to-emerald-600' : 'from-blue-600 to-blue-700') }} text-white rounded-xl p-4 mr-5 flex-shrink-0 text-center min-w-[5rem] shadow-lg">
                                            <div class="text-xs font-bold uppercase tracking-wide">{{ $schedule->scheduled_at->format('M') }}</div>
                                            <div class="text-4xl font-bold my-1">{{ $schedule->scheduled_at->format('d') }}</div>
                                            <div class="text-xs font-medium">{{ $schedule->scheduled_at->format('Y') }}</div>
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between">
                                                <div>
                                                    <h4 class="font-bold text-gray-900 text-xl mb-2">{{ $schedule->getTranslation('title', app()->getLocale()) }}</h4>
                                                    @if($schedule->description)
                                                        <p class="text-gray-600 text-base mt-2 leading-relaxed">{{ $schedule->getTranslation('description', app()->getLocale()) }}</p>
                                                    @endif
                                                </div>
                                                @if($isToday)
                                                    <span class="px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-500 text-white text-sm font-bold rounded-full whitespace-nowrap ml-3 shadow-lg animate-pulse">{{ __('TODAY') }}</span>
                                                @endif
                                            </div>
                                            <div class="flex flex-wrap items-center gap-4 mt-4 text-base text-gray-700">
                                                <span class="flex items-center font-semibold bg-blue-50 px-4 py-2 rounded-lg">
                                                    <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $schedule->scheduled_at->format('H:i') }} ({{ $schedule->duration_minutes }} {{ __('min') }})
                                                </span>
                                                @if($schedule->meeting_link)
                                                    <a href="{{ $schedule->meeting_link }}" target="_blank" 
                                                       class="group flex items-center px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg">
                                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                                        </svg>
                                                        {{ __('Join Meeting') }}
                                                    </a>
                                                @elseif($program->meeting_link)
                                                    <a href="{{ $program->meeting_link }}" target="_blank" 
                                                       class="group flex items-center px-5 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-md hover:shadow-lg">
                                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                                        </svg>
                                                        {{ __('Join Meeting') }}
                                                    </a>
                                                @endif
                                            </div>

                                            <!-- Attendance Button -->
                                            @if($schedule->attendance_enabled)
                                                <div class="mt-5 pt-5 border-t-2 border-gray-200">
                                                    @if($hasAttended)
                                                        <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                                            <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center mr-3 shadow-md">
                                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                                </svg>
                                                            </div>
                                                            <div>
                                                                <span class="font-bold text-green-700 text-lg">{{ __('Attended') }}</span>
                                                                <p class="text-sm text-green-600 mt-0.5">{{ $userAttendances[$schedule->id]->attended_at->format('d M Y H:i') }}</p>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <button 
                                                            onclick="markAttendance({{ $schedule->id }})"
                                                            class="group w-full inline-flex items-center justify-center px-6 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                            </svg>
                                                            {{ __('Mark Attendance') }}
                                                        </button>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Empty State - No Content Available -->
                    @if($program->delivery_type === 'online_course' && $program->courses->count() === 0 && !$program->syllabus)
                        <div class="group relative bg-white rounded-2xl border border-gray-200 overflow-hidden p-16 text-center shadow-xl">
                            <!-- Decorative Elements -->
                            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>
                            <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl"></div>
                            
                            <div class="relative">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ __('Content Coming Soon') }}</h3>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">{{ __('Course materials are being prepared. Please check back later for updates.') }}</p>
                            </div>
                        </div>
                    @endif

                    @if($program->delivery_type === 'online_zoom' && $program->schedules->count() === 0 && !$program->syllabus)
                        <div class="group relative bg-white rounded-2xl border border-gray-200 overflow-hidden p-16 text-center shadow-xl">
                            <!-- Decorative Elements -->
                            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500/5 rounded-full blur-3xl"></div>
                            <div class="absolute bottom-0 left-0 w-64 h-64 bg-green-500/5 rounded-full blur-3xl"></div>
                            
                            <div class="relative">
                                <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-green-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ __('Schedule Coming Soon') }}</h3>
                                <p class="text-gray-600 mb-8 max-w-md mx-auto leading-relaxed">{{ __('Live session schedules will be announced soon. Stay tuned!') }}</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Program Info Card -->
                    <div class="group relative bg-white rounded-2xl shadow-xl border border-gray-200 p-8 overflow-hidden hover:shadow-2xl transition-all duration-300">
                        <!-- Glow Effect -->
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-amber-500/10 rounded-full blur-2xl group-hover:from-blue-500/20 group-hover:to-amber-500/20 transition-all"></div>
                        
                        <h3 class="relative text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            {{ __('Program Information') }}
                        </h3>
                        <div class="relative space-y-5">
                            <div class="p-4 bg-gradient-to-r from-blue-50 to-amber-50 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">{{ __('Type') }}</p>
                                <p class="text-lg font-bold text-gray-900">{{ ucfirst($program->type) }}</p>
                            </div>
                            <div class="p-4 bg-gradient-to-r from-amber-50 to-blue-50 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">{{ __('Delivery Method') }}</p>
                                <p class="text-lg font-bold text-gray-900">
                                    @if($program->delivery_type === 'online_zoom')
                                        {{ __('Live Online Sessions') }}
                                    @else
                                        {{ __('Self-Paced Course') }}
                                    @endif
                                </p>
                            </div>
                            <div class="p-4 bg-gradient-to-r from-blue-50 to-amber-50 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">{{ __('Start Date') }}</p>
                                <p class="text-lg font-bold text-gray-900">{{ $program->start_date->format('d F Y') }}</p>
                            </div>
                            <div class="p-4 bg-gradient-to-r from-amber-50 to-blue-50 rounded-xl">
                                <p class="text-xs text-gray-500 uppercase tracking-wide font-semibold mb-2">{{ __('Enrollment Date') }}</p>
                                <p class="text-lg font-bold text-gray-900">{{ $registration->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    @if($program->delivery_type === 'online_course')
                        <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-amber-600 rounded-2xl shadow-2xl p-8 text-white overflow-hidden">
                            <!-- Decorative Elements -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
                            <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                            
                            <h3 class="relative text-2xl font-bold mb-6 flex items-center">
                                <div class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                {{ __('Your Progress') }}
                            </h3>
                            <div class="relative space-y-5">
                                <div class="p-5 bg-white/10 backdrop-blur-sm rounded-xl">
                                    <p class="text-blue-100 text-sm font-medium mb-2">{{ __('Total Courses') }}</p>
                                    <p class="text-4xl font-bold">{{ $program->courses->count() }}</p>
                                </div>
                                <div class="p-5 bg-white/10 backdrop-blur-sm rounded-xl">
                                    <p class="text-blue-100 text-sm font-medium mb-2">{{ __('Total Modules') }}</p>
                                    <p class="text-4xl font-bold">{{ $program->courses->sum(function($course) { return $course->modules->count(); }) }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
    function markAttendance(scheduleId) {
        const button = event.target.closest('button');
        const originalHTML = button.innerHTML;
        
        // Disable button and show loading
        button.disabled = true;
        button.innerHTML = '<svg class="w-6 h-6 mr-2 animate-spin inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> {{ __("Processing...") }}';
        
        fetch(`/my-programs/{{ $program->slug }}/attendance/${scheduleId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload page to show updated attendance status
                location.reload();
            } else {
                alert(data.message || 'Failed to mark attendance');
                button.disabled = false;
                button.innerHTML = originalHTML;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
            button.disabled = false;
            button.innerHTML = originalHTML;
        });
    }
    </script>
</x-app-layout>
