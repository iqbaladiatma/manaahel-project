<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-gold dark:from-dark-bg dark:via-dark-card dark:to-dark-bg/5 dark:from-dark-bg dark:via-dark-card dark:to-dark-bg transition-colors duration-200">
        <!-- Hero Header -->
        <section class="relative pt-20 sm:pt-24 md:pt-28 pb-12 sm:pb-16 md:pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-r from-blue-primary to-blue-600 dark:from-blue-dark dark:to-dark-bg transition-colors duration-200">
            <!-- Decorative Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                            <path d="M50 0 L60 20 L80 20 L65 32 L70 50 L50 38 L30 50 L35 32 L20 20 L40 20 Z" fill="currentColor"/>
                            <circle cx="50" cy="50" r="8" fill="currentColor" opacity="0.5"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#pattern)"/>
                </svg>
            </div>

            <!-- Decorative Circles -->
            <div class="absolute top-10 left-10 w-32 sm:w-48 h-32 sm:h-48 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 right-10 w-40 sm:w-64 h-40 sm:h-64 bg-gold/10 rounded-full blur-3xl"></div>
            
            <div class="max-w-7xl mx-auto relative z-10">
                <div class="text-center animate-fade-in">
                    <!-- Icon -->
                    <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 md:w-24 md:h-24 gradient-gold rounded-full mb-4 sm:mb-6 shadow-2xl dark:shadow-gold/20 animate-bounce-slow">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                    </div>

                    <!-- Arabic Title -->
                    <div class="mb-3 sm:mb-4">
                        <p class="text-xl sm:text-2xl md:text-3xl text-white/90" style="font-family: 'Times New Roman', serif; direction: rtl;">
                            أَكَادِيمِيَّةُ مَنَاهِل
                        </p>
                    </div>

                    <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white dark:text-gray-100 mb-4 sm:mb-6 leading-tight">
                        Manaahel <span class="text-gold dark:text-gold-light">Academy</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg md:text-xl text-blue-100 dark:text-gray-300 max-w-3xl mx-auto mb-6 sm:mb-8 leading-relaxed px-4">
                        Program Pembelajaran Eksklusif untuk Pengembangan Diri dan Spiritual Anda
                    </p>

                    <!-- Stats -->
                    <div class="flex flex-wrap justify-center gap-4 sm:gap-6 md:gap-8 mb-6 sm:mb-8">
                        <div class="bg-white/10 dark:bg-dark-card/50 backdrop-blur-sm rounded-xl px-4 sm:px-6 py-3 sm:py-4 border border-white/20 dark:border-gold/20">
                            <div class="text-2xl sm:text-3xl font-bold text-white dark:text-gold">{{ $programs->count() }}</div>
                            <div class="text-xs sm:text-sm text-blue-100 dark:text-gray-300">Program Aktif</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 sm:px-6 py-3 sm:py-4">
                            <div class="text-2xl sm:text-3xl font-bold text-white">100+</div>
                            <div class="text-xs sm:text-sm text-blue-100">Peserta</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl px-4 sm:px-6 py-3 sm:py-4">
                            <div class="text-2xl sm:text-3xl font-bold text-white">4.9</div>
                            <div class="text-xs sm:text-sm text-blue-100">Rating</div>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    @guest
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center gradient-gold text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full text-sm sm:text-base font-bold hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:scale-105">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Daftar Sekarang
                    </a>
                    @endguest
                </div>
            </div>
        </section>

        <!-- Programs Section -->
        <section class="py-12 sm:py-16 md:py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                @if($programs->isEmpty())
                    <!-- Empty State -->
                    <div class="text-center py-16 sm:py-20">
                        <div class="inline-flex items-center justify-center w-20 h-20 sm:w-24 sm:h-24 bg-gray-100 dark:bg-dark-card rounded-full mb-4 sm:mb-6 border border-gray-200 dark:border-dark-border">
                            <svg class="w-10 h-10 sm:w-12 sm:h-12 text-gray-400 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">Belum Ada Program</h3>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400">Program Academy akan segera hadir. Pantau terus!</p>
                    </div>
                @else
                    <!-- Section Title -->
                    <div class="text-center mb-8 sm:mb-12">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-3 sm:mb-4">Program Tersedia</h2>
                        <div class="w-20 sm:w-24 h-1 gradient-gold dark:bg-gradient-to-r dark:from-gold-dark dark:to-gold mx-auto mb-3 sm:mb-4"></div>
                        <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Pilih program yang sesuai dengan kebutuhan pembelajaran Anda</p>
                    </div>

                    <!-- Programs Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
                        @foreach($programs as $program)
                            <div class="group bg-white dark:bg-dark-card rounded-2xl shadow-lg dark:shadow-dark-border overflow-hidden hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:-translate-y-2 border border-gray-100 dark:border-dark-border">
                                <!-- Image/Placeholder -->
                                @if($program->image)
                                    <div class="relative h-48 sm:h-56 overflow-hidden">
                                        <img src="{{ Storage::url($program->image) }}" 
                                             alt="{{ $program->name }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                                    </div>
                                @else
                                    <div class="relative h-48 sm:h-56 gradient-blue overflow-hidden">
                                        <div class="absolute inset-0 opacity-20">
                                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                                <pattern id="dots-{{ $loop->index }}" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                                                    <circle cx="2" cy="2" r="1" fill="white"/>
                                                </pattern>
                                                <rect width="100%" height="100%" fill="url(#dots-{{ $loop->index }})"/>
                                            </svg>
                                        </div>
                                        <div class="absolute inset-0 flex items-center justify-center">
                                            <svg class="w-16 h-16 sm:w-20 sm:h-20 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                            </svg>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Content -->
                                <div class="p-5 sm:p-6">
                                    <!-- Title -->
                                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 sm:mb-3 line-clamp-2 group-hover:text-blue-primary dark:group-hover:text-gold transition-colors">
                                        {{ $program->name }}
                                    </h3>
                                    
                                    <!-- Description -->
                                    <p class="text-sm sm:text-base text-gray-600 dark:text-gray-400 mb-4 sm:mb-5 line-clamp-2 leading-relaxed">
                                        {{ $program->description }}
                                    </p>
                                    
                                    <!-- Info Grid -->
                                    <div class="flex items-center justify-between mb-4 sm:mb-5 pb-4 sm:pb-5 border-b border-gray-100 dark:border-dark-border">
                                        <!-- Date -->
                                        <div class="flex items-center text-gray-600 dark:text-gray-400">
                                            <div class="w-8 h-8 sm:w-9 sm:h-9 bg-blue-50 dark:bg-blue-dark/20 dark:bg-blue-dark/30 rounded-lg flex items-center justify-center mr-2">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 text-blue-primary dark:text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs text-gray-500 dark:text-gray-500">Mulai</p>
                                                <p class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-gray-200">{{ $program->start_date?->format('d M Y') ?? 'TBA' }}</p>
                                            </div>
                                        </div>

                                        <!-- Price -->
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mb-0.5">Investasi</p>
                                            @if($program->price > 0)
                                                <div class="text-lg sm:text-xl font-bold gradient-gold-text">
                                                    Rp {{ number_format($program->price / 1000, 0, ',', '.') }}k
                                                </div>
                                            @else
                                                <div class="text-lg sm:text-xl font-bold text-green-600">GRATIS</div>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Participants -->
                                    @if($program->max_participants)
                                    <div class="flex items-center text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-4 sm:mb-5">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span>Kuota: <strong>{{ $program->max_participants }} peserta</strong></span>
                                    </div>
                                    @endif
                                    
                                    <!-- CTA Button -->
                                    <a href="{{ route('academy.show', $program->slug) }}" 
                                       class="group/btn block w-full gradient-blue text-white py-3 sm:py-3.5 rounded-xl text-sm sm:text-base font-bold hover:shadow-xl dark:hover:shadow-gold/20 transition-all duration-300 text-center transform hover:scale-105 flex items-center justify-center">
                                        <span>Lihat Detail & Daftar</span>
                                        <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-12 sm:py-16 md:py-20 px-4 sm:px-6 lg:px-8 gradient-blue dark:bg-gradient-to-r dark:from-dark-card dark:to-dark-bg relative overflow-hidden transition-colors duration-200">
            <!-- Pattern -->
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="cta-pattern" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse">
                            <circle cx="40" cy="40" r="2" fill="white"/>
                            <path d="M40 20 L50 40 L40 60 L30 40 Z" fill="white" opacity="0.3"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#cta-pattern)"/>
                </svg>
            </div>

            <div class="max-w-4xl mx-auto text-center relative z-10">
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-white dark:text-gray-100 mb-4 sm:mb-6">
                    Siap Memulai Perjalanan Belajar?
                </h2>
                <p class="text-base sm:text-lg text-blue-100 dark:text-gray-300 mb-6 sm:mb-8 max-w-2xl mx-auto">
                    Bergabunglah dengan ribuan santri lainnya dalam program pembelajaran yang terstruktur dan berkualitas
                </p>
                @guest
                <a href="{{ route('register') }}" 
                   class="inline-flex items-center gradient-gold text-white px-6 sm:px-8 py-3 sm:py-4 rounded-full text-sm sm:text-base font-bold hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:scale-105">
                    Daftar Gratis Sekarang
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                @else
                <a href="{{ route('dashboard') }}" 
                   class="inline-flex items-center bg-white dark:bg-dark-card text-blue-primary dark:text-gold px-6 sm:px-8 py-3 sm:py-4 rounded-full text-sm sm:text-base font-bold hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:scale-105 border border-transparent dark:border-gold/30">
                    Ke Dashboard
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                @endguest
            </div>
        </section>
    </div>
</x-app-layout>
