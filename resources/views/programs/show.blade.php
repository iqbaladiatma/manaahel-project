<x-app-layout>
    <div class="py-8 sm:py-12 mt-16 sm:mt-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-4 sm:mb-6">
                <a href="{{ route('programs.index') }}" 
                   class="inline-flex items-center text-blue-primary hover:text-blue-primary:text-emerald-300 transition-colors text-sm sm:text-base">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Programs') }}
                </a>
            </div>

            <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                <div class="p-4 sm:p-6 md:p-8">
                    <!-- Program Title -->
                    <div class="mb-6">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $program->type === 'academy' ? 'bg-blue-50 text-blue-700' : 'bg-purple-50 text-purple-700' }}">
                                {{ ucfirst($program->type) }}
                            </span>
                            
                            @if($program->status)
                                <span class="flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-primary">
                                    <span class="w-2 h-2 bg-blue-light rounded-full mr-2"></span>
                                    {{ __('Registration Open') }}
                                </span>
                            @else
                                <span class="px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    {{ __('Registration Closed') }}
                                </span>
                            @endif
                        </div>

                        <h1 class="text-3xl font-bold text-gray-900 mb-4">
                            {{ $program->getTranslation('name', app()->getLocale()) }}
                        </h1>
                    </div>

                    <!-- Program Description -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Description') }}</h3>
                        <div class="prose max-w-none text-gray-600">
                            {!! nl2br(e($program->getTranslation('description', app()->getLocale()))) !!}
                        </div>
                    </div>

                    <!-- Program Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <h4 class="font-semibold text-gray-700 mb-2">{{ __('Program Fees') }}</h4>
                            <p class="text-2xl font-bold text-gray-900">
                                @if($program->fees > 0)
                                    Rp {{ number_format($program->fees, 0, ',', '.') }}
                                @else
                                    {{ __('Free') }}
                                @endif
                            </p>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <h4 class="font-semibold text-gray-700 mb-2">{{ __('Start Date') }}</h4>
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $program->start_date->format('d F Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Delivery Type -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">{{ __('Delivery Method') }}</h3>
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-lg p-6 border border-blue-200">
                            @if($program->delivery_type === 'online_zoom')
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-blue-900 text-lg">{{ __('Online Via Zoom/Google Meet') }}</p>
                                        <p class="text-blue-700 mt-1">{{ __('Live interactive sessions with instructors') }}</p>
                                    </div>
                                </div>
                            @else
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-blue-600 mr-3 flex-shrink-0 mt-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                                    </svg>
                                    <div>
                                        <p class="font-semibold text-blue-900 text-lg">{{ __('Online Course') }}</p>
                                        <p class="text-yellow-700 mt-1">{{ __('Self-paced video-based learning') }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Syllabus Section -->
                    @if($program->syllabus)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                </svg>
                                {{ __('Course Syllabus') }}
                            </h3>
                            <div class="prose max-w-none text-gray-600 bg-gray-50 rounded-lg p-6 border border-gray-200">
                                {!! nl2br(e($program->getTranslation('syllabus', app()->getLocale()))) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Course Modules (for online_course type) -->
                    @if($program->delivery_type === 'online_course' && $program->courses->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                                </svg>
                                {{ __('Course Content') }}
                            </h3>
                            <div class="space-y-4">
                                @foreach($program->courses as $courseIndex => $course)
                                    <div class="border border-gray-200 rounded-lg overflow-hidden hover:border-blue-300 transition">
                                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-4">
                                            <h4 class="font-bold text-gray-900 flex items-center">
                                                <span class="bg-blue-600 text-white rounded-full w-7 h-7 flex items-center justify-center text-sm mr-3">
                                                    {{ $courseIndex + 1 }}
                                                </span>
                                                {{ $course->getTranslation('title', app()->getLocale()) }}
                                            </h4>
                                            @if($course->description)
                                                <p class="text-gray-600 text-sm mt-2 ml-10">{{ $course->getTranslation('description', app()->getLocale()) }}</p>
                                            @endif
                                        </div>
                                        @if($course->modules->count() > 0)
                                            <div class="divide-y divide-gray-200">
                                                @foreach($course->modules as $module)
                                                    <div class="px-4 py-3 hover:bg-blue-50/50 transition flex items-center justify-between">
                                                        <div class="flex items-center flex-1">
                                                            <svg class="w-5 h-5 text-gray-400 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                                                            </svg>
                                                            <span class="text-gray-700">{{ $module->getTranslation('title', app()->getLocale()) }}</span>
                                                        </div>
                                                        @if($module->duration_minutes)
                                                            <span class="text-sm text-gray-500 ml-4">{{ $module->duration_minutes }} {{ __('min') }}</span>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Program Schedule (for online_zoom type) -->
                    @if($program->delivery_type === 'online_zoom' && $program->schedules->count() > 0)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Program Schedule') }}
                            </h3>
                            <div class="space-y-3">
                                @foreach($program->schedules as $schedule)
                                    <div class="flex items-start border border-gray-200 rounded-lg p-4 hover:border-blue-300 hover:bg-blue-50/30 transition">
                                        <div class="bg-blue-600 text-white rounded-lg p-3 mr-4 flex-shrink-0 text-center min-w-[4rem]">
                                            <div class="text-xs font-medium">{{ $schedule->scheduled_at->format('M') }}</div>
                                            <div class="text-2xl font-bold">{{ $schedule->scheduled_at->format('d') }}</div>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-900">{{ $schedule->getTranslation('title', app()->getLocale()) }}</h4>
                                            @if($schedule->description)
                                                <p class="text-gray-600 text-sm mt-1">{{ $schedule->getTranslation('description', app()->getLocale()) }}</p>
                                            @endif
                                            <div class="flex items-center gap-4 mt-2 text-sm text-gray-500">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $schedule->scheduled_at->format('H:i') }} - {{ $schedule->duration_minutes }} {{ __('minutes') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Registration Section -->
                    @if($program->status)
                        <div class="border-t border-gray-200 pt-8">
                            @if(isset($isEnrolled) && $isEnrolled)
                                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                                    <div class="flex items-center mb-4">
                                        <div class="flex-shrink-0 bg-green-100 rounded-full p-2 mr-3">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-bold text-green-800">{{ __('You are already enrolled!') }}</h3>
                                            <p class="text-green-700">{{ __('You have full access to this program.') }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('enrolled.show', $program->slug) }}" 
                                       class="inline-flex items-center px-8 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                        {{ __('Go to Learning Dashboard') }}
                                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                        </svg>
                                    </a>
                                </div>
                            @else
                                <h3 class="text-lg font-semibold text-gray-900 mb-4">{{ __('Register for this Program') }}</h3>
                                
                                @auth
                                    <a href="{{ route('registrations.create', ['program' => $program->id]) }}" 
                                       class="inline-flex items-center px-8 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary transition-colors">
                                        {{ __('Register Now') }}
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                        </svg>
                                    </a>
                                @else
                                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-6">
                                        <p class="text-amber-800 mb-4">
                                            {{ __('You need to be logged in to register for this program.') }}
                                        </p>
                                        <div class="flex gap-3">
                                            <a href="{{ route('login') }}" 
                                               class="inline-flex items-center px-6 py-3 bg-blue-primary text-white font-medium rounded-lg hover:bg-blue-primary transition-colors">
                                                {{ __('Login') }}
                                            </a>
                                            <a href="{{ route('register') }}" 
                                               class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-medium rounded-lg hover:bg-gray-800:bg-gray-100 transition-colors">
                                                {{ __('Register Account') }}
                                            </a>
                                        </div>
                                    </div>
                                @endauth
                            @endif
                        </div>
                    @else
                        <div class="border-t border-gray-200 pt-8">
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                                <p class="text-gray-700 font-semibold">
                                    {{ __('Registration for this program is currently closed.') }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


