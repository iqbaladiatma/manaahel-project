<x-app-layout>
    <!-- Hero Section with Islamic Pattern -->
    <section class="relative pt-32 pb-20 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-br from-blue-50 via-white to-gold/5">
        <!-- Decorative Islamic Pattern Background -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="islamic-pattern" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse">
                        <path d="M50 0 L60 20 L80 20 L65 32 L70 50 L50 38 L30 50 L35 32 L20 20 L40 20 Z" fill="currentColor" class="text-blue-primary"/>
                        <circle cx="50" cy="50" r="8" fill="currentColor" class="text-gold"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#islamic-pattern)"/>
            </svg>
        </div>

        <!-- Floating Arabic Calligraphy Elements -->
        <div class="absolute top-20 right-10 text-gold/10 text-9xl font-bold animate-float" style="font-family: 'Times New Roman', serif;">بسم</div>
        <div class="absolute bottom-20 left-10 text-blue-primary/10 text-8xl font-bold animate-float-delayed" style="font-family: 'Times New Roman', serif;">الله</div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <!-- Left Content -->
                <div class="animate-slide-up">
                    <!-- Arabic Bismillah -->
                    <div class="text-center md:text-right mb-8">
                        <p class="text-4xl md:text-5xl text-blue-primary mb-2" style="font-family: 'Times New Roman', serif; direction: rtl;">
                            بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                        </p>
                        <p class="text-sm text-gray-600 italic">Bismillahirrahmanirrahim</p>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                        Menuntut Ilmu Bersama <span class="gradient-gold-text">Manaahel</span>
                    </h1>
                    
                    <!-- Arabic Quote -->
                    <div class="bg-white/80 backdrop-blur-sm border-r-4 border-gold p-6 rounded-lg mb-6 shadow-lg">
                        <p class="text-2xl text-gray-800 mb-2" style="font-family: 'Times New Roman', serif; direction: rtl; text-align: right;">
                            طَلَبُ الْعِلْمِ فَرِيضَةٌ عَلَى كُلِّ مُسْلِمٍ
                        </p>
                        <p class="text-sm text-gray-600 italic border-t border-gray-200 pt-2">
                            "Menuntut ilmu adalah kewajiban bagi setiap muslim"
                        </p>
                        <p class="text-xs text-gray-500 mt-1">- HR. Ibnu Majah</p>
                    </div>

                    <p class="text-gray-700 text-lg mb-8 leading-relaxed">
                        Platform pembelajaran Islami yang didedikasikan untuk meningkatkan pemahaman agama dan pengetahuan umum melalui metode yang mudah dipahami dan sesuai syariat.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        @auth
                        <a href="{{ route('dashboard') }}" class="group gradient-blue text-white px-10 py-4 rounded-full font-semibold hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"/>
                            </svg>
                            Dashboard
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="group gradient-blue text-white px-10 py-4 rounded-full font-semibold hover:shadow-2xl transition-all duration-300 text-center transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                            Mulai Belajar
                        </a>
                        <a href="{{ route('programs.index') }}" class="group border-2 border-gold text-gold px-10 py-4 rounded-full font-semibold hover:bg-gold hover:text-white transition-all duration-300 text-center transform hover:scale-105 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                            Lihat Program
                        </a>
                        @endauth
                    </div>
                </div>

                <!-- Right Content - Islamic Book Illustration -->
                <div class="relative animate-fade-in">
                    <!-- Decorative Frame -->
                    <div class="absolute -inset-4 bg-gradient-to-r from-gold/20 to-blue-primary/20 rounded-3xl blur-2xl"></div>
                    
                    <div class="relative bg-white rounded-3xl p-8 shadow-2xl border-4 border-gold/30">
                        <!-- Islamic Ornament Top -->
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-32 h-12 gradient-gold rounded-full flex items-center justify-center shadow-lg">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>

                        <div class="text-center">
                            <!-- Book Icon with Animation -->
                            <div class="relative inline-block mb-6">
                                <div class="absolute inset-0 gradient-blue rounded-full blur-xl opacity-50 animate-pulse"></div>
                                <div class="relative gradient-blue rounded-full p-8">
                                    <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                </div>
                            </div>

                            <h3 class="text-4xl font-bold gradient-gold-text mb-3">{{ $totalMembers ?? 150 }}+</h3>
                            <p class="text-gray-600 font-medium mb-6">Santri Bergabung</p>

                            <!-- Arabic Decoration -->
                            <div class="border-t-2 border-b-2 border-gold/30 py-4">
                                <p class="text-3xl text-blue-primary" style="font-family: 'Times New Roman', serif;">
                                    ٱلْحَمْدُ لِلَّٰهِ
                                </p>
                                <p class="text-sm text-gray-600 mt-1">Alhamdulillah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section with Islamic Design -->
    <section class="py-16 bg-white relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 bg-gradient-to-b from-blue-50/50 to-transparent"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Section Title with Arabic -->
            <div class="text-center mb-12">
                <p class="text-2xl text-gold mb-2" style="font-family: 'Times New Roman', serif;">مَا شَاءَ اللّٰهُ</p>
                <h2 class="text-3xl font-bold text-gray-900">Pencapaian Kami</h2>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Stat Card 1 -->
                <div class="group bg-white p-8 rounded-2xl text-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-blue-100 hover:border-blue-primary relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 gradient-blue opacity-10 rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 gradient-blue rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-blue-primary mb-2">{{ $totalMembers ?? 150 }}+</div>
                        <div class="text-gray-600 font-semibold">Santri Aktif</div>
                    </div>
                </div>

                <!-- Stat Card 2 -->
                <div class="group bg-white p-8 rounded-2xl text-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-gold/30 hover:border-gold relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 gradient-gold opacity-10 rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 gradient-gold rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold gradient-gold-text mb-2">{{ $totalPrograms ?? 10 }}+</div>
                        <div class="text-gray-600 font-semibold">Program Kajian</div>
                    </div>
                </div>

                <!-- Stat Card 3 -->
                <div class="group bg-white p-8 rounded-2xl text-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-gold/30 hover:border-gold relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 gradient-gold opacity-10 rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 gradient-gold rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold gradient-gold-text mb-2">15+</div>
                        <div class="text-gray-600 font-semibold">Ustadz & Asatidz</div>
                    </div>
                </div>

                <!-- Stat Card 4 -->
                <div class="group bg-white p-8 rounded-2xl text-center shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-2 border-blue-100 hover:border-blue-primary relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-20 h-20 gradient-blue opacity-10 rounded-bl-full"></div>
                    <div class="relative">
                        <div class="w-16 h-16 gradient-blue rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold text-blue-primary mb-2">4.9</div>
                        <div class="text-gray-600 font-semibold">Rating Kepuasan</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section with Islamic Theme -->
    @if(isset($featuredPrograms) && $featuredPrograms->count() > 0)
    <section class="py-20 bg-gradient-to-b from-gray-50 to-white px-4 sm:px-6 lg:px-8 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-10 left-10 w-32 h-32 border-4 border-gold/20 rounded-full"></div>
        <div class="absolute bottom-10 right-10 w-40 h-40 border-4 border-blue-primary/20 rounded-full"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <div class="text-center mb-16 animate-fade-in">
                <!-- Arabic Title -->
                <div class="mb-4">
                    <p class="text-3xl text-gold arabic-glow" style="font-family: 'Times New Roman', serif; direction: rtl;">
                        بَرَامِجُنَا
                    </p>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Program Kajian Kami</h2>
                <div class="w-24 h-1 gradient-gold mx-auto mb-6"></div>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Pilih program kajian sesuai kebutuhan untuk meningkatkan pemahaman agama dan ilmu pengetahuan</p>
            </div>
            <div class="grid md:grid-cols-2 gap-10">
                @foreach($featuredPrograms as $program)
                <div class="group bg-white rounded-3xl shadow-xl overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border-2 {{ $program->type === 'academy' ? 'border-blue-100 hover:border-blue-primary' : 'border-gold/30 hover:border-gold' }}">
                    <!-- Header with Islamic Pattern -->
                    <div class="relative {{ $program->type === 'academy' ? 'gradient-blue' : 'gradient-gold' }} h-40 overflow-hidden">
                        <div class="absolute inset-0 opacity-20">
                            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                <pattern id="pattern-{{ $loop->index }}" x="0" y="0" width="50" height="50" patternUnits="userSpaceOnUse">
                                    <circle cx="25" cy="25" r="3" fill="white"/>
                                    <path d="M25 15 L30 25 L25 35 L20 25 Z" fill="white" opacity="0.5"/>
                                </pattern>
                                <rect width="100%" height="100%" fill="url(#pattern-{{ $loop->index }})"/>
                            </svg>
                        </div>
                        
                        <!-- Ornament -->
                        <div class="absolute top-4 right-4 w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>

                        <div class="absolute bottom-4 left-6">
                            <span class="inline-block bg-white/90 backdrop-blur-sm {{ $program->type === 'academy' ? 'text-blue-primary' : 'text-gold' }} px-5 py-2 rounded-full text-sm font-bold shadow-lg">
                                {{ $program->type === 'academy' ? '📚 Academy' : '🏆 Competition' }}
                            </span>
                        </div>
                    </div>

                    <div class="p-8">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:{{ $program->type === 'academy' ? 'text-blue-primary' : 'text-gold' }} transition-colors">
                            {{ $program->getTranslation('name', app()->getLocale()) }}
                        </h3>

                        <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">
                            {{ $program->getTranslation('description', app()->getLocale()) }}
                        </p>

                        <!-- Info Grid -->
                        <div class="grid grid-cols-2 gap-4 mb-6 pb-6 border-b-2 border-gray-100">
                            <div class="flex items-center text-gray-600">
                                <div class="w-10 h-10 {{ $program->type === 'academy' ? 'bg-blue-50 text-blue-primary' : 'bg-yellow-50 text-gold' }} rounded-lg flex items-center justify-center mr-3">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Mulai</p>
                                    <p class="font-semibold">{{ $program->start_date->format('M Y') }}</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-xs text-gray-500 mb-1">Investasi</p>
                                <div class="text-2xl font-bold {{ $program->type === 'academy' ? 'gradient-blue-text' : 'gradient-gold-text' }}">
                                    @if($program->fees > 0)
                                        Rp {{ number_format($program->fees, 0, ',', '.') }}
                                    @else
                                        Gratis
                                    @endif
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('programs.show', $program->slug) }}" 
                           class="group/btn block w-full {{ $program->type === 'academy' ? 'gradient-blue' : 'gradient-gold' }} text-white py-4 rounded-full font-semibold hover:shadow-xl transition-all duration-300 text-center transform hover:scale-105 flex items-center justify-center">
                            Daftar Sekarang
                            <svg class="w-5 h-5 ml-2 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('programs.index') }}" class="inline-flex items-center gradient-blue text-white px-8 py-3 rounded-full font-medium hover:opacity-90 transition shadow-lg">
                    Lihat Semua Program
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    <!-- Latest News -->
    @if(isset($featuredArticles) && $featuredArticles->count() > 0)
    <section class="py-16 bg-gray-50 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Berita Terbaru</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan dan informasi terbaru dari kami</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($featuredArticles->take(3) as $article)
                <a href="{{ route('articles.show', $article->slug) }}" class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition">
                    @if($article->image_url)
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $article->image_url }}" 
                             alt="{{ $article->getTranslation('title', app()->getLocale()) }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    </div>
                    @endif
                    <div class="p-6">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-sm text-gray-500">{{ $article->created_at->format('d M Y') }}</span>
                            @if($article->category)
                            <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-50 text-blue-primary">
                                {{ $article->category->getTranslation('name', app()->getLocale()) }}
                            </span>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-blue-primary transition">
                            {{ $article->getTranslation('title', app()->getLocale()) }}
                        </h3>
                        <p class="text-gray-600 line-clamp-2">
                            {{ Str::limit($article->getTranslation('content', app()->getLocale()), 100) }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- About Section -->
    <section class="py-16 bg-white px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Tentang Manaahel</h2>
                    <p class="text-gray-600 mb-4 leading-relaxed">
                        Manaahel adalah platform pembelajaran yang didedikasikan untuk membantu meningkatkan pengetahuan dan keterampilan melalui program-program berkualitas.
                    </p>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Kami menyediakan metode pembelajaran yang terstruktur, mudah dipahami, dan dapat diakses kapan saja, di mana saja.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="gradient-gold text-white p-2 rounded-lg mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Pengajar Berpengalaman</h4>
                                <p class="text-gray-600">Belajar dari para pengajar yang berpengalaman di bidangnya</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="gradient-gold text-white p-2 rounded-lg mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Materi Terstruktur</h4>
                                <p class="text-gray-600">Kurikulum yang disusun secara sistematis dan bertahap</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="gradient-gold text-white p-2 rounded-lg mr-4 flex-shrink-0">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800 mb-1">Fleksibel</h4>
                                <p class="text-gray-600">Belajar sesuai waktu dan kecepatan Anda sendiri</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-blue-50 p-6 rounded-2xl text-center">
                        <div class="text-4xl font-bold text-blue-primary mb-2">{{ $totalMembers ?? 150 }}+</div>
                        <div class="text-gray-600">Anggota Aktif</div>
                    </div>
                    <div class="bg-yellow-50 p-6 rounded-2xl text-center">
                        <div class="text-4xl font-bold gradient-gold-text mb-2">{{ $totalPrograms ?? 10 }}+</div>
                        <div class="text-gray-600">Program Tersedia</div>
                    </div>
                    <div class="bg-yellow-50 p-6 rounded-2xl text-center">
                        <div class="text-4xl font-bold gradient-gold-text mb-2">15+</div>
                        <div class="text-gray-600">Pengajar</div>
                    </div>
                    <div class="bg-blue-50 p-6 rounded-2xl text-center">
                        <div class="text-4xl font-bold text-blue-primary mb-2">4.9</div>
                        <div class="text-gray-600">Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section with Islamic Design -->
    <section class="relative py-24 gradient-blue px-4 sm:px-6 lg:px-8 overflow-hidden">
        <!-- Islamic Pattern Overlay -->
        <div class="absolute inset-0 opacity-10">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="cta-pattern" x="0" y="0" width="80" height="80" patternUnits="userSpaceOnUse">
                        <circle cx="40" cy="40" r="2" fill="white"/>
                        <path d="M40 20 L50 40 L40 60 L30 40 Z" fill="white" opacity="0.3"/>
                        <circle cx="40" cy="40" r="15" fill="none" stroke="white" stroke-width="0.5"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#cta-pattern)"/>
            </svg>
        </div>

        <!-- Decorative Circles -->
        <div class="absolute top-10 left-10 w-64 h-64 bg-white/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-80 h-80 bg-gold/10 rounded-full blur-3xl"></div>

        <div class="max-w-5xl mx-auto text-center relative z-10">
            <!-- Arabic Calligraphy -->
            <div class="mb-8 animate-fade-in">
                <p class="text-5xl md:text-6xl text-white/90 mb-3 arabic-glow" style="font-family: 'Times New Roman', serif; direction: rtl;">
                    وَقُل رَّبِّ زِدْنِي عِلْمًا
                </p>
                <p class="text-white/80 text-lg italic">"Dan katakanlah: Ya Tuhanku, tambahkanlah kepadaku ilmu pengetahuan"</p>
                <p class="text-white/60 text-sm mt-2">- QS. Taha: 114</p>
            </div>

            <div class="w-32 h-1 gradient-gold mx-auto mb-8"></div>

            <h2 class="text-4xl md:text-5xl font-bold text-white mb-6 animate-slide-up">
                Bergabunglah Bersama Kami
            </h2>
            <p class="text-blue-50 text-xl mb-10 max-w-3xl mx-auto leading-relaxed">
                Mulai perjalanan menuntut ilmu Anda bersama ribuan santri lainnya. Raih keberkahan ilmu yang bermanfaat untuk dunia dan akhirat.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center mb-8">
                <a href="{{ route('register') }}" class="group gradient-gold text-white px-12 py-5 rounded-full font-bold hover:shadow-2xl transition-all duration-300 transform hover:scale-110 flex items-center text-lg">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"/>
                    </svg>
                    Daftar Sekarang
                    <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a href="{{ route('about') }}" class="group bg-white/10 backdrop-blur-sm text-white px-12 py-5 rounded-full font-bold hover:bg-white/20 transition-all duration-300 border-2 border-white/40 hover:border-white flex items-center text-lg">
                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    Pelajari Lebih Lanjut
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="flex flex-wrap justify-center gap-8 mt-12 pt-8 border-t border-white/20">
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">{{ $totalMembers ?? 150 }}+</div>
                    <div class="text-blue-100 text-sm">Santri Terdaftar</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">4.9/5</div>
                    <div class="text-blue-100 text-sm">Rating Kepuasan</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-white mb-1">15+</div>
                    <div class="text-blue-100 text-sm">Ustadz Berpengalaman</div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
