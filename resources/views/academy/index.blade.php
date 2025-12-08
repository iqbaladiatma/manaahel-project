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

                    <!-- Arabic Greeting -->
                    <div class="mb-4">
                        <p class="text-2xl sm:text-3xl text-gold-light mb-2" style="font-family: 'Times New Roman', serif; direction: rtl;">
                            مَرْحَبًا بِكُمْ
                        </p>
                        <p class="text-sm text-blue-100 italic">Marhaban Bikum - Selamat Datang</p>
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

        <!-- About Manaahel Academy Section -->
        <section class="py-12 sm:py-16 md:py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-dark-bg transition-colors duration-200">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-8 sm:mb-12">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-3 sm:mb-4">Tentang Manaahel Academy</h2>
                    <div class="w-20 sm:w-24 h-1 gradient-gold mx-auto mb-3 sm:mb-4"></div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 sm:gap-12 items-center mb-12">
                    <!-- Left Content -->
                    <div class="space-y-6">
                        <div class="bg-gradient-to-br from-blue-50 to-gold/10 dark:from-dark-card dark:to-dark-card/50 rounded-2xl p-6 sm:p-8 border-l-4 border-blue-primary dark:border-gold shadow-lg dark:shadow-dark-border">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 gradient-gold rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Filosofi Liburan Bermakna</h3>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                        Liburan sejati bukanlah hanya sekedar rehat dari penat. Bukan hanya sekedar bersenang-senang tanpa arah dan tujuan yang jelas. Tapi justru liburan inilah sebagai sarana <strong class="text-blue-primary dark:text-gold">mengupgrade diri</strong>, mencharge semangat belajar baru dengan mengisinya dengan kegiatan yang bermanfaat.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-dark-card rounded-2xl p-6 sm:p-8 shadow-lg dark:shadow-dark-border border border-gray-100 dark:border-dark-border">
                            <div class="flex items-start mb-4">
                                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-dark/30 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-6 h-6 text-blue-primary dark:text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Inisiatif Kami</h3>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                        Kami dari <strong class="text-blue-primary dark:text-gold">Forum Manaahel Generation</strong> dibawah pengawasan Divisi Acara & Pengembangan SDM mempersembahkan MANAAHEL ACADEMY. Program pelatihan baca kitab online yang diampu oleh anggota kami yang insya Allah berkompeten.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Program Details -->
                    <div class="bg-gradient-to-br from-blue-primary to-blue-600 dark:from-blue-dark dark:to-dark-bg rounded-2xl p-6 sm:p-8 shadow-2xl dark:shadow-gold/20 text-white">
                        <div class="flex items-center mb-6">
                            <div class="w-14 h-14 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold">Program Baca Kitab Online</h3>
                        </div>

                        <div class="space-y-4">
                            <!-- Muqorror -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="font-semibold mb-1">Muqorror</p>
                                        <p class="text-sm text-blue-100">Sesuai kesepakatan antara pengampu dengan peserta</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Waktu -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="font-semibold mb-1">Waktu</p>
                                        <p class="text-sm text-blue-100">Fleksibel tergantung kesepakatan dengan pengampu selama masa liburan semester</p>
                                    </div>
                                </div>
                            </div>

                            <!-- HTM -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="font-semibold mb-1">HTM</p>
                                        <p class="text-sm text-blue-100"><strong class="text-gold">Tidak dipungut biaya (GRATIS)</strong></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sistem Pembelajaran -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                <div class="flex items-start">
                                    <svg class="w-5 h-5 text-gold mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    <div>
                                        <p class="font-semibold mb-1">Sistem Pembelajaran</p>
                                        <p class="text-sm text-blue-100">Face to face (VC/Zoom) atau Voice Note</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Requirements Section -->
                <div class="bg-gradient-to-br from-gold/10 to-blue-50 dark:from-dark-card dark:to-dark-card/50 rounded-2xl p-6 sm:p-8 border border-gold/30 dark:border-gold/20 shadow-lg dark:shadow-dark-border">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 gradient-gold rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Syarat & Ketentuan</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white dark:bg-dark-bg rounded-xl p-5 shadow-sm border border-gray-100 dark:border-dark-border">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-dark/30 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <span class="text-blue-primary dark:text-gold font-bold">1</span>
                                </div>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300">Peserta khusus <strong class="text-blue-primary dark:text-gold">ikhwan kalangan sendiri</strong> (santri aktif Alfurqon) jenjang menengah kebawah</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-dark-bg rounded-xl p-5 shadow-sm border border-gray-100 dark:border-dark-border">
                            <div class="flex items-start">
                                <div class="w-8 h-8 bg-blue-100 dark:bg-blue-dark/30 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                    <span class="text-blue-primary dark:text-gold font-bold">2</span>
                                </div>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300">Bersedia mengikuti kegiatan ini <strong class="text-blue-primary dark:text-gold">selama masa liburan</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media & Contact -->
                <div class="mt-8 sm:mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Follow Us -->
                    <div class="bg-white dark:bg-dark-card rounded-2xl p-6 shadow-lg dark:shadow-dark-border border border-gray-100 dark:border-dark-border">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Follow Instagram Kami</h4>
                        </div>
                        <div class="space-y-3">
                            <a href="https://www.instagram.com/manaahel._" target="_blank" class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-lg hover:shadow-md transition-all group">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">@manaahel._</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-primary dark:group-hover:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                            <a href="https://www.instagram.com/manaahel.academy" target="_blank" class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-pink-900/20 rounded-lg hover:shadow-md transition-all group">
                                <span class="text-gray-700 dark:text-gray-300 font-medium">@manaahel.academy</span>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-primary dark:group-hover:text-gold transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl p-6 shadow-lg dark:shadow-dark-border border border-green-200 dark:border-green-800/30">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 bg-green-500 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 dark:text-gray-100">Info Lebih Lanjut</h4>
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 mb-4">Hubungi kami untuk informasi lebih detail tentang program</p>
                        <a href="https://wa.me/6281515802615" target="_blank" class="flex items-center justify-center w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                            </svg>
                            Chat WhatsApp: 081515802615
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Programs Section -->
        <section class="py-12 sm:py-16 md:py-20 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-dark-card/30 transition-colors duration-200">
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
