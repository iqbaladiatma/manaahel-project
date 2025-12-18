<x-app-layout>
    <!-- Hero Section with Islamic Pattern -->
    <div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 dark:from-dark-bg dark:via-blue-dark dark:to-dark-bg overflow-hidden">
        <!-- Islamic Pattern Background -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="islamic-pattern-dashboard" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                        <path d="M50 0 L60 20 L80 20 L65 32 L70 50 L50 38 L30 50 L35 32 L20 20 L40 20 Z" fill="currentColor" class="text-white"/>
                        <circle cx="50" cy="50" r="8" fill="currentColor" class="text-gold"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#islamic-pattern-dashboard)"/>
            </svg>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gold/10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-400/10 rounded-full blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16 relative z-10">
            <!-- Welcome Header -->
            <div class="text-center mb-8">
                <!-- Arabic Greeting -->
                <div class="mb-4">
                    <p class="text-3xl sm:text-4xl md:text-5xl font-bold text-gold-light mb-2 animate-fade-in" style="font-family: 'Times New Roman', serif; direction: rtl;">
                        أَهْلاً وَسَهْلاً
                    </p>
                    <p class="text-sm sm:text-base text-blue-100 italic">
                        Ahlan Wa Sahlan - Selamat Datang Kembali
                    </p>
                </div>

                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-3 animate-slide-up">
                    {{ Auth::user()->name }}
                </h1>
                <p class="text-base sm:text-lg text-blue-100 max-w-2xl mx-auto">
                    Mari lanjutkan perjalanan belajar Anda hari ini
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

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <!-- Stat 1: Programs - DISABLED -->
                <!-- 
                <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gold/20 rounded-full blur-2xl group-hover:bg-gold/30 transition-all"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-white mb-2">{{ $enrolledPrograms->count() }}</div>
                        <div class="text-sm text-blue-100 font-medium">Program Aktif</div>
                    </div>
                </div>
                -->

                <!-- Stat 2: Courses -->
                <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-gold/20 rounded-full blur-2xl group-hover:bg-gold/30 transition-all"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-white mb-2">{{ $totalCourses }}</div>
                        <div class="text-sm text-blue-100 font-medium">Kursus Tersedia</div>
                    </div>
                </div>

                <!-- Stat 3: Progress -->
                <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-green-400/20 rounded-full blur-2xl group-hover:bg-green-400/30 transition-all"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-white mb-2">{{ $progressPercentage }}%</div>
                        <div class="text-sm text-blue-100 font-medium">Progress Belajar</div>
                    </div>
                </div>

                <!-- Stat 4: Member Since -->
                <div class="group relative bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 hover:bg-white/20 transition-all duration-300 overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-purple-400/20 rounded-full blur-2xl group-hover:bg-purple-400/30 transition-all"></div>
                    <div class="relative">
                        <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-lg font-bold text-white mb-1">Bergabung Pada</div>
                        <div class="text-sm text-blue-100 font-medium">{{ Auth::user()->created_at->format('d M Y') }}</div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 mt-6">
                <!-- Completed Modules -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 hover:bg-white/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-100 mb-1">Modul Selesai</p>
                            <p class="text-2xl font-bold text-white">{{ $completedModules }} / {{ $totalModules }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                                <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Modules -->
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-5 hover:bg-white/20 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-100 mb-1">Total Modul</p>
                            <p class="text-2xl font-bold text-white">{{ $totalModules }}</p>
                        </div>
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="py-12 bg-gray-50 dark:bg-dark-bg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- My Enrolled Programs - DISABLED -->
            <!-- 
            @if($enrolledPrograms->count() > 0)
                <div>
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('My Enrolled Programs') }}</h2>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Continue your learning journey') }}</p>
                        </div>
                        <a href="{{ route('enrolled.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:shadow-lg dark:shadow-dark-border transition-all">
                            {{ __('View All') }}
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($enrolledPrograms->take(3) as $registration)
                            @php $program = $registration->program; @endphp
                            <div class="group relative bg-white dark:bg-dark-card rounded-2xl border border-gray-200 dark:border-dark-border overflow-hidden hover:border-blue-500 transition-all duration-300 shadow-lg dark:shadow-dark-border hover:shadow-2xl dark:hover:shadow-gold/20">
                                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-blue-500/10 to-amber-500/10 rounded-full blur-3xl group-hover:from-blue-500/20 group-hover:to-amber-500/20 transition-all"></div>
                                
                                <div class="relative bg-gradient-to-r from-blue-600 to-blue-700 dark:from-gold-dark dark:to-gold p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <span class="px-3 py-1 bg-white/20 dark:bg-dark-card/40 backdrop-blur-sm text-white text-xs font-semibold rounded-full border border-white/20 dark:border-gold/30">
                                            {{ ucfirst($program->type) }}
                                        </span>
                                        <span class="px-3 py-1 bg-green-500 dark:bg-green-600 text-white text-xs font-semibold rounded-full">
                                            ✓ {{ __('Enrolled') }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-white line-clamp-2">
                                        {{ $program->name }}
                                    </h3>
                                </div>

                                <div class="relative p-6">
                                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                        {{ Str::limit($program->description, 100) }}
                                    </p>

                                    <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100 dark:border-dark-border">
                                        <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                            <svg class="w-4 h-4 mr-1 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                            </svg>
                                            {{ $program->courses()->where('is_published', true)->count() }} {{ __('Courses') }}
                                        </div>
                                    </div>

                                    <a href="{{ route('enrolled.show', $program->slug) }}" 
                                       class="block w-full text-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-xl hover:shadow-lg dark:shadow-dark-border transition-all">
                                        {{ __('Continue Learning') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            -->

            <!-- My Academy Programs -->
            @php
                $academyRegistrations = Auth::user()->academyRegistrations()->with('academyProgram')->latest()->get();
            @endphp

            @if($academyRegistrations->count() > 0)
                <!-- Academy Section Header with Islamic Design -->
                <div class="relative bg-gradient-to-r from-amber-50 via-gold/5 to-amber-50 dark:from-dark-card dark:via-gold/5 dark:to-dark-card rounded-3xl p-8 mb-8 overflow-hidden border-2 border-gold/30 dark:border-gold/50">
                    <!-- Decorative Pattern -->
                    <div class="absolute inset-0 opacity-5">
                        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <pattern id="academy-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                                    <circle cx="30" cy="30" r="2" fill="currentColor" class="text-gold"/>
                                    <path d="M30 15 L35 30 L30 45 L25 30 Z" fill="currentColor" class="text-gold" opacity="0.3"/>
                                </pattern>
                            </defs>
                            <rect width="100%" height="100%" fill="url(#academy-pattern)"/>
                        </svg>
                    </div>

                    <div class="relative z-10">
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-4">
                                <!-- Icon -->
                                <div class="w-16 h-16 gradient-gold rounded-2xl flex items-center justify-center shadow-lg dark:shadow-dark-border">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                    </svg>
                                </div>
                                
                                <div>
                                    <!-- Arabic Text -->
                                    <p class="text-lg text-gold dark:text-gold-light mb-1" style="font-family: 'Times New Roman', serif; direction: rtl;">
                                        أَكَادِيمِيَّتِي
                                    </p>
                                    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Program Academy Saya</h2>
                                    <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $academyRegistrations->count() }} program terdaftar</p>
                                </div>
                            </div>

                            <a href="{{ route('academy.index') }}" class="inline-flex items-center px-6 py-3 gradient-gold text-white font-semibold rounded-xl hover:shadow-lg dark:shadow-dark-border transition-all transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Jelajahi Academy
                            </a>
                        </div>
                    </div>
                </div>

                <div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($academyRegistrations as $registration)
                            @php $program = $registration->academyProgram; @endphp
                            <div class="group relative bg-white dark:bg-dark-card rounded-2xl border-2 border-amber-200 overflow-hidden hover:border-amber-400 transition-all duration-300 shadow-lg dark:shadow-dark-border hover:shadow-2xl dark:hover:shadow-gold/20">
                                <!-- Glow Effect -->
                                <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-amber-500/10 to-gold/10 rounded-full blur-3xl group-hover:from-amber-500/20 group-hover:to-gold/20 transition-all"></div>
                                
                                <!-- Program Image/Header -->
                                @if($program->image)
                                    <div class="relative h-40 overflow-hidden">
                                        <img src="{{ Storage::url($program->image) }}" alt="{{ $program->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                        <div class="absolute bottom-3 left-3 right-3">
                                            <span class="inline-block px-3 py-1 bg-green-50 dark:bg-green-900/200 text-white text-xs font-semibold rounded-full">
                                                ✓ {{ __('Registered') }}
                                            </span>
                                        </div>
                                    </div>
                                @else
                                    <div class="relative h-40 gradient-gold flex items-center justify-center">
                                        <div class="absolute inset-0 opacity-20">
                                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                                <pattern id="dots-{{ $loop->index }}" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                                    <circle cx="2" cy="2" r="1" fill="white"/>
                                                </pattern>
                                                <rect width="100%" height="100%" fill="url(#dots-{{ $loop->index }})"/>
                                            </svg>
                                        </div>
                                        <svg class="w-16 h-16 text-white relative z-10" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                        </svg>
                                        <div class="absolute bottom-3 left-3 right-3">
                                            <span class="inline-block px-3 py-1 bg-green-50 dark:bg-green-900/200 text-white text-xs font-semibold rounded-full">
                                                ✓ {{ __('Registered') }}
                                            </span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Program Content -->
                                <div class="relative p-6">
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 line-clamp-2">
                                        {{ $program->name }}
                                    </h3>
                                    <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2 text-sm">
                                        {{ Str::limit($program->description, 100) }}
                                    </p>

                                    <div class="flex items-center gap-4 mb-4 pb-4 border-b border-gray-100 dark:border-dark-border">
                                        @if($program->start_date)
                                            <div class="flex items-center text-xs text-gray-600 dark:text-gray-400">
                                                <svg class="w-4 h-4 mr-1 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                                </svg>
                                                {{ $program->start_date->format('d M Y') }}
                                            </div>
                                        @endif
                                        @if($program->price > 0)
                                            <div class="flex items-center text-xs font-semibold text-amber-600">
                                                Rp {{ number_format($program->price, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <div class="flex items-center text-xs font-semibold text-green-600">
                                                GRATIS
                                            </div>
                                        @endif
                                    </div>

                                    @if($registration->whatsapp_group_link)
                                        <a href="{{ $registration->whatsapp_group_link }}" 
                                           target="_blank"
                                           class="block w-full text-center px-4 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-xl transition-all transform hover:scale-105 shadow-md flex items-center justify-center">
                                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                            </svg>
                                            {{ __('Join WhatsApp Group') }}
                                        </a>
                                    @else
                                        <div class="block w-full text-center px-4 py-3 bg-gray-100 dark:bg-dark-card text-gray-500 dark:text-gray-500 font-semibold rounded-xl">
                                            {{ __('No WhatsApp Group') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <!-- Empty State for Academy -->
                <div class="relative bg-gradient-to-br from-amber-50 via-gold/10 to-amber-50 dark:from-dark-card dark:via-gold/5 dark:to-dark-card rounded-3xl p-12 text-center overflow-hidden border-2 border-gold/30 dark:border-gold/50">
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gold/10 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-400/10 rounded-full blur-3xl"></div>
                    
                    <div class="relative z-10">
                        <!-- Icon -->
                        <div class="w-24 h-24 gradient-gold rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-2xl dark:shadow-gold/20 animate-pulse">
                            <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>

                        <!-- Arabic Text -->
                        <div class="mb-4">
                            <p class="text-2xl text-gold dark:text-gold-light mb-2" style="font-family: 'Times New Roman', serif; direction: rtl;">
                                اِبْدَأْ رِحْلَتَكَ
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 italic">Ibda' Rihlataka - Mulai Perjalananmu</p>
                        </div>

                        <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">Belum Ada Program Academy</h3>
                        <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                            Bergabunglah dengan program Academy kami untuk mendalami ilmu agama dan mengembangkan diri bersama komunitas yang solid
                        </p>

                        <!-- Features -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8 max-w-3xl mx-auto">
                            <div class="bg-white/50 dark:bg-dark-bg/50 backdrop-blur-sm rounded-xl p-4 border border-gold/20">
                                <div class="w-10 h-10 gradient-gold rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Materi Berkualitas</p>
                            </div>
                            <div class="bg-white/50 dark:bg-dark-bg/50 backdrop-blur-sm rounded-xl p-4 border border-gold/20">
                                <div class="w-10 h-10 gradient-gold rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Komunitas Solid</p>
                            </div>
                            <div class="bg-white/50 dark:bg-dark-bg/50 backdrop-blur-sm rounded-xl p-4 border border-gold/20">
                                <div class="w-10 h-10 gradient-gold rounded-lg flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">Sertifikat Resmi</p>
                            </div>
                        </div>

                        <a href="{{ route('academy.index') }}" 
                           class="inline-flex items-center px-10 py-4 gradient-gold text-white font-bold rounded-xl hover:shadow-2xl dark:hover:shadow-gold/20 transition-all transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Jelajahi Program Academy
                        </a>
                    </div>
                </div>
            @endif

            <!-- Quick Actions -->
            <div>
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ __('Quick Actions') }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ __('Explore and manage your account') }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Browse Programs - DISABLED -->
                    <!-- 
                    <a href="{{ route('programs.index') }}" class="group relative bg-white dark:bg-dark-card rounded-2xl border border-gray-200 dark:border-dark-border p-8 hover:border-amber-500 hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 rounded-full blur-2xl group-hover:from-amber-500/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg dark:shadow-dark-border group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-amber-600 transition-colors">{{ __('Browse Programs') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Explore available learning programs') }}</p>
                        </div>
                    </a>
                    -->

                    <!-- My Profile -->
                    <a href="{{ route('profile.show') }}" class="group relative bg-white dark:bg-dark-card rounded-2xl border border-gray-200 dark:border-dark-border p-8 hover:border-blue-500 hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 rounded-full blur-2xl group-hover:from-blue-500/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl flex items-center justify-center mb-4 shadow-lg dark:shadow-dark-border group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-blue-600 dark:hover:text-gold transition-colors">{{ __('My Profile') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('View and edit your profile') }}</p>
                        </div>
                    </a>

                    <!-- Academy Programs -->
                    <a href="{{ route('academy.index') }}" class="group relative bg-white dark:bg-dark-card rounded-2xl border border-gray-200 dark:border-dark-border p-8 hover:border-amber-500 hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 rounded-full blur-2xl group-hover:from-amber-500/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mb-4 shadow-lg dark:shadow-dark-border group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-amber-600 transition-colors">{{ __('Academy Programs') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Explore exclusive learning programs') }}</p>
                        </div>
                    </a>

                    <!-- Articles -->
                    <a href="{{ route('articles.index') }}" class="group relative bg-white dark:bg-dark-card rounded-2xl border border-gray-200 dark:border-dark-border p-8 hover:border-green-500 hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-green-500/10 rounded-full blur-2xl group-hover:from-green-500/20 transition-all"></div>
                        <div class="relative">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mb-4 shadow-lg dark:shadow-dark-border group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-green-600 transition-colors">{{ __('Articles') }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ __('Read latest articles and news') }}</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Empty State for No Programs - DISABLED -->
            <!-- 
            @if($enrolledPrograms->count() === 0)
                <div class="relative bg-gradient-to-br from-blue-50 to-amber-50 dark:from-dark-card dark:to-dark-bg rounded-2xl p-16 text-center overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 dark:bg-blue-900/5 rounded-full blur-3xl"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-amber-50 dark:bg-amber-900/5 rounded-full blur-3xl"></div>
                    
                    <div class="relative">
                        <div class="w-24 h-24 bg-gradient-to-br from-blue-600 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-2xl dark:shadow-gold/20">
                            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Start Your Learning Journey') }}</h3>
                        <p class="text-xl text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">{{ __('Explore our programs and enroll to begin your educational adventure') }}</p>
                        <a href="{{ route('programs.index') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:shadow-2xl dark:hover:shadow-gold/20 transition-all transform hover:-translate-y-1">
                            {{ __('Browse Programs') }}
                            <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
            -->
        </div>
    </div>
</x-app-layout>
