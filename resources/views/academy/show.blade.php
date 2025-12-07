<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-gold dark:from-dark-bg dark:via-dark-card dark:to-dark-bg/5 dark:from-dark-bg dark:via-dark-card dark:to-dark-bg transition-colors duration-200">
        <section class="relative pt-20 sm:pt-24 pb-8 sm:pb-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-r from-blue-primary to-blue-600 dark:from-blue-dark dark:to-dark-bg transition-colors duration-200">
            <div class="absolute inset-0 opacity-10">
                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                            <path d="M50 0 L60 20 L80 20 L65 32 L70 50 L50 38 L30 50 L35 32 L20 20 L40 20 Z" fill="currentColor"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#pattern)"/>
                </svg>
            </div>
            
            <div class="max-w-7xl mx-auto relative z-10">
                <a href="{{ route('academy.index') }}" class="inline-flex items-center text-blue-100 hover:text-white mb-4 sm:mb-6 transition-colors group">
                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    <span class="text-sm sm:text-base">Kembali ke Daftar Program</span>
                </a>

                <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white dark:text-gray-100 mb-3 sm:mb-4 leading-tight">
                    {{ $program->name }}
                </h1>

                <div class="flex flex-wrap gap-3 sm:gap-4">
                    @if($program->start_date)
                    <div class="flex items-center bg-white/10 dark:bg-dark-card/40 backdrop-blur-sm rounded-lg px-3 sm:px-4 py-2 border border-white/20 dark:border-gold/30">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-sm sm:text-base text-white">{{ $program->start_date->format('d F Y') }}</span>
                    </div>
                    @endif

                    @if($program->max_participants)
                    <div class="flex items-center bg-white/10 dark:bg-dark-card/40 backdrop-blur-sm rounded-lg px-3 sm:px-4 py-2 border border-white/20 dark:border-gold/30">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="text-sm sm:text-base text-white">{{ $program->max_participants }} Peserta</span>
                    </div>
                    @endif

                    <div class="flex items-center bg-gold/20 dark:bg-gold/30 backdrop-blur-sm rounded-lg px-3 sm:px-4 py-2 border border-gold/30 dark:border-gold/50">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-white mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                        </svg>
                        @if($program->price > 0)
                            <span class="text-sm sm:text-base text-white font-bold">Rp {{ number_format($program->price, 0, ',', '.') }}</span>
                        @else
                            <span class="text-sm sm:text-base text-white font-bold">GRATIS</span>
                        @endif
                    </div>
                </div>
            </div>
        </section>


        <section class="py-8 sm:py-12 md:py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 sm:gap-8">
                    <div class="lg:col-span-2 space-y-6 sm:space-y-8">
                        @if($program->image)
                        <div class="relative rounded-2xl overflow-hidden shadow-xl dark:shadow-dark-border group">
                            <img src="{{ Storage::url($program->image) }}" alt="{{ $program->name }}" class="w-full h-56 sm:h-64 md:h-80 object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>
                        @endif

                        <div class="bg-white dark:bg-dark-card rounded-2xl shadow-lg dark:shadow-dark-border p-6 sm:p-8 border-t-4 border-gold dark:border-gold-dark transition-colors duration-200">
                            <div class="flex items-center mb-4 sm:mb-6">
                                <div class="w-10 h-10 sm:w-12 sm:h-12 gradient-gold rounded-full flex items-center justify-center mr-3 sm:mr-4">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                </div>
                                <h2 class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100">Tentang Program</h2>
                            </div>
                            <p class="text-sm sm:text-base text-gray-700 dark:text-gray-300 leading-relaxed mb-6">{{ $program->description }}</p>

                            @if($program->details)
                            <div class="border-t border-gray-200 dark:border-dark-border pt-6">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                                    <svg class="w-5 h-5 text-gold mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                    </svg>
                                    Detail Program
                                </h3>
                                <div class="prose prose-sm sm:prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300">
                                    {!! $program->details !!}
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>


                    <div class="lg:col-span-1">
                        <div class="sticky top-4 space-y-4 sm:space-y-6">
                            <div class="bg-white dark:bg-dark-card rounded-2xl shadow-xl dark:shadow-dark-border p-5 sm:p-6 border-t-4 border-blue-primary dark:border-gold transition-colors duration-200">
                                <div class="text-center mb-5 sm:mb-6 pb-5 sm:pb-6 border-b border-gray-100 dark:border-dark-border">
                                    @if($program->price > 0)
                                        <div class="text-3xl sm:text-4xl font-bold gradient-gold-text mb-2">
                                            Rp {{ number_format($program->price, 0, ',', '.') }}
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Investasi Pembelajaran</p>
                                    @else
                                        <div class="inline-block gradient-gold text-white px-6 py-3 rounded-full text-2xl sm:text-3xl font-bold shadow-lg dark:shadow-dark-border mb-2">
                                            GRATIS
                                        </div>
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400">Tanpa Biaya Pendaftaran</p>
                                    @endif
                                </div>

                                <div class="space-y-3 sm:space-y-4 mb-5 sm:mb-6">
                                    @if($program->start_date)
                                    <div class="flex items-start p-3 bg-blue-50 rounded-xl">
                                        <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="flex-1">
                                            <div class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 font-medium">Tanggal Mulai</div>
                                            <div class="text-sm sm:text-base font-semibold text-gray-900 dark:text-gray-200">{{ $program->start_date->format('d F Y') }}</div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($program->end_date)
                                    <div class="flex items-start p-3 bg-blue-50 rounded-xl">
                                        <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="flex-1">
                                            <div class="text-xs sm:text-sm text-gray-600 font-medium">Tanggal Selesai</div>
                                            <div class="text-sm sm:text-base font-semibold text-gray-900 dark:text-gray-100">{{ $program->end_date->format('d F Y') }}</div>
                                        </div>
                                    </div>
                                    @endif

                                    @if($program->max_participants)
                                    <div class="flex items-start p-3 bg-blue-50 rounded-xl">
                                        <svg class="w-5 h-5 text-blue-primary dark:text-gold mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <div class="flex-1">
                                            <div class="text-xs sm:text-sm text-gray-600 font-medium">Kuota Peserta</div>
                                            <div class="text-sm sm:text-base font-semibold text-gray-900 dark:text-gray-100">{{ $program->max_participants }} Orang</div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                @if(session('error'))
                                <div class="mb-4 p-3 sm:p-4 bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 rounded-lg">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-xs sm:text-sm text-red-800">{{ session('error') }}</p>
                                    </div>
                                </div>
                                @endif

                                @if(session('info'))
                                <div class="mb-4 p-3 sm:p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-blue-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-xs sm:text-sm text-blue-800">{{ session('info') }}</p>
                                    </div>
                                </div>
                                @endif

                                @if(session('success'))
                                <div class="mb-4 p-3 sm:p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                                    <div class="flex items-start">
                                        <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        <p class="text-xs sm:text-sm text-green-800">{{ session('success') }}</p>
                                    </div>
                                </div>
                                @endif


                                @auth
                                    @if(!auth()->user()->hasCompleteProfileForAcademy())
                                        <div class="bg-amber-50 dark:bg-amber-900/20 border-2 border-amber-300 dark:border-amber-700 rounded-xl p-4 sm:p-5">
                                            <div class="flex items-start mb-3 sm:mb-4">
                                                <svg class="w-5 h-5 sm:w-6 sm:h-6 text-amber-600 mr-2 sm:mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                <div class="flex-1">
                                                    <h3 class="font-semibold text-amber-900 dark:text-amber-300 text-sm sm:text-base mb-1">Profil Belum Lengkap</h3>
                                                    <p class="text-xs sm:text-sm text-amber-800 dark:text-amber-400 mb-3">Lengkapi profil Anda (Nama, Email, No. WhatsApp) untuk mendaftar.</p>
                                                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center gradient-gold text-white font-semibold py-2 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 shadow-md text-xs sm:text-sm">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                        Lengkapi Profil
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($alreadyRegistered)
                                        <div class="bg-green-50 dark:bg-green-900/20 border-2 border-green-200 dark:border-green-700 rounded-xl p-5 sm:p-6 text-center">
                                            <svg class="w-14 h-14 sm:w-16 sm:h-16 text-green-600 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <p class="text-green-800 dark:text-green-300 font-bold text-base sm:text-lg mb-1">Anda Sudah Terdaftar</p>
                                            <p class="text-xs sm:text-sm text-green-700 dark:text-green-400">Anda sudah terdaftar di program ini</p>
                                        </div>
                                    @else
                                        <form action="{{ route('academy.register', $program->slug) }}" method="POST" class="space-y-4">
                                            @csrf
                                            
                                            <div class="bg-blue-50 dark:bg-blue-dark/20 border border-blue-200 dark:border-blue-dark/30 rounded-xl p-3 sm:p-4">
                                                <p class="text-xs sm:text-sm text-blue-800 dark:text-blue-300 flex items-start">
                                                    <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                                    </svg>
                                                    <span>Pendaftaran menggunakan data profil: <strong>{{ auth()->user()->name }}</strong></span>
                                                </p>
                                            </div>

                                            <div>
                                                <label for="notes" class="block text-xs sm:text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Catatan (Opsional)</label>
                                                <textarea name="notes" id="notes" rows="3" class="w-full px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-300 dark:border-dark-border bg-white dark:bg-dark-bg text-gray-900 dark:text-gray-100 rounded-xl focus:ring-2 focus:ring-blue-primary dark:focus:ring-gold focus:border-transparent dark:border-dark-border dark:bg-dark-bg dark:text-gray-100" placeholder="Tulis pertanyaan atau catatan...">{{ old('notes') }}</textarea>
                                            </div>

                                            <button type="submit" class="w-full gradient-blue text-white font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-xl text-sm sm:text-base transition-all duration-200 transform hover:scale-105 shadow-lg dark:shadow-dark-border hover:shadow-xl dark:hover:shadow-gold/20 flex items-center justify-center">
                                                <svg class="w-4 h-4 sm:w-5 sm:h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Daftar Sekarang
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <div class="bg-gradient-to-br from-gold/10 to-blue-50 dark:from-gold/5 dark:to-dark-card border-2 border-gold dark:border-gold-dark rounded-xl p-5 sm:p-6 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 gradient-gold rounded-full mb-4 shadow-lg dark:shadow-dark-border">
                                            <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                            </svg>
                                        </div>
                                        <h3 class="text-lg sm:text-xl font-bold text-gray-900 dark:text-gray-100 mb-2">Login Diperlukan</h3>
                                        <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 mb-5 sm:mb-6">Login untuk mendaftar program Academy dengan data profil Anda.</p>
                                        
                                        <div class="space-y-3">
                                            <a href="{{ route('login') }}" class="block w-full gradient-blue text-white font-bold py-3 sm:py-4 px-4 sm:px-6 rounded-xl text-sm sm:text-base transition-all duration-200 transform hover:scale-105 shadow-lg dark:shadow-dark-border hover:shadow-xl dark:hover:shadow-gold/20">
                                                Login Sekarang
                                            </a>
                                            <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-500 dark:text-gray-400">Belum punya akun?</p>
                                            <a href="{{ route('register') }}" class="block w-full border-2 border-blue-primary dark:border-gold text-blue-primary dark:text-gold font-semibold py-2.5 sm:py-3 px-4 sm:px-6 rounded-xl text-sm sm:text-base transition-all duration-200 hover:bg-blue-primary dark:hover:bg-gold hover:text-white">
                                                Daftar Akun Baru
                                            </a>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
