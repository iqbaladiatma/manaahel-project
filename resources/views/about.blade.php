<x-app-layout>
    <!-- Hero Section with Animation -->
    <div class="relative bg-gradient-to-br from-blue-50 via-white to-gold/5 pt-32 pb-16 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute top-20 right-10 w-64 h-64 bg-blue-primary/5 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-10 left-10 w-80 h-80 bg-gold/5 rounded-full blur-3xl animate-pulse-slow" style="animation-delay: 1s;"></div>
        
        <!-- Islamic Pattern -->
        <div class="absolute inset-0 opacity-5">
            <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="about-pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse">
                        <circle cx="30" cy="30" r="2" fill="currentColor" class="text-blue-primary"/>
                        <path d="M30 15 L35 30 L30 45 L25 30 Z" fill="currentColor" class="text-gold" opacity="0.3"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#about-pattern)"/>
            </svg>
        </div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <!-- Arabic Bismillah -->
            <div class="mb-6 fade-in-up">
                <p class="text-3xl text-blue-primary arabic-glow" style="font-family: 'Times New Roman', serif; direction: rtl;">
                    بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ
                </p>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-4 animate-fade-in">
                {{ __('About Manaahel') }}
            </h1>
            <div class="w-24 h-1 gradient-gold mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto animate-slide-up leading-relaxed">
                {{ __('Empowering learners worldwide through education and community') }}
            </p>
            
            <!-- Decorative Quote -->
            <div class="mt-8 max-w-3xl mx-auto bg-white/80 backdrop-blur-sm border-l-4 border-gold p-6 rounded-lg shadow-lg zoom-in">
                <p class="text-lg text-gray-700 italic">
                    "{{ __('Education is the most powerful weapon which you can use to change the world') }}"
                </p>
            </div>
        </div>
    </div>

    <!-- Our Story with Timeline -->
    <div class="py-20 bg-gray-50 relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-blue-primary/5 rounded-full blur-3xl"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">{{ __('Our Story') }}</h2>
                <div class="w-24 h-1 gradient-blue mx-auto"></div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center mb-16">
                <!-- Story Content -->
                <div class="space-y-6 slide-in-left">
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover-lift border-l-4 border-blue-primary">
                        <div class="flex items-start">
                            <div class="w-12 h-12 gradient-blue rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Our Vision') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('Manaahel Platform was founded with a vision to democratize education and create a global community of learners. We believe that quality education should be accessible to everyone, regardless of their location or background.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover-lift border-l-4 border-gold">
                        <div class="flex items-start">
                            <div class="w-12 h-12 gradient-gold rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Our Community') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('Our platform brings together students, educators, and professionals from around the world, fostering collaboration, innovation, and lifelong learning. Through our comprehensive programs and supportive community, we help individuals achieve their personal and professional goals.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover-lift border-l-4 border-blue-primary">
                        <div class="flex items-start">
                            <div class="w-12 h-12 gradient-blue rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('Our Impact') }}</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    {{ __('Today, Manaahel serves thousands of members across multiple countries, offering diverse programs in technology, business, and personal development.') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Stats Cards -->
                <div class="grid grid-cols-2 gap-6 slide-in-right">
                    <div class="bg-white p-8 rounded-2xl shadow-xl text-center interactive-card border-2 border-blue-100">
                        <div class="w-16 h-16 gradient-blue rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold gradient-blue-text mb-2">100+</div>
                        <div class="text-gray-600 font-medium">{{ __('Courses') }}</div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-xl text-center interactive-card border-2 border-gold/30">
                        <div class="w-16 h-16 gradient-gold rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold gradient-gold-text mb-2">5K+</div>
                        <div class="text-gray-600 font-medium">{{ __('Students') }}</div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-xl text-center interactive-card border-2 border-gold/30">
                        <div class="w-16 h-16 gradient-gold rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold gradient-gold-text mb-2">50+</div>
                        <div class="text-gray-600 font-medium">{{ __('Countries') }}</div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-xl text-center interactive-card border-2 border-blue-100">
                        <div class="w-16 h-16 gradient-blue rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>
                        <div class="text-4xl font-bold gradient-blue-text mb-2">4.9</div>
                        <div class="text-gray-600 font-medium">{{ __('Rating') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vision & Mission -->
    <div class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-xl p-8 border-2 border-blue-100 hover:border-blue-primary hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 gradient-blue rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Vision') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('To be the leading platform that empowers individuals worldwide through accessible education, fostering innovation, and building a connected community of lifelong learners.') }}
                    </p>
                </div>

                <div class="bg-white rounded-xl p-8 border-2 border-gold/30 hover:border-gold hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="w-14 h-14 gradient-gold rounded-xl flex items-center justify-center mb-6 shadow-lg">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Mission') }}</h3>
                    <p class="text-gray-600 leading-relaxed">
                        {{ __('We provide high-quality educational programs, facilitate meaningful connections among members, and create opportunities for personal and professional growth.') }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Organization Structure -->
    @if(isset($leaders) && $leaders->count() > 0)
    <div class="py-16 bg-gray-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ __('Organization Structure') }}</h2>
                <p class="text-gray-600">{{ __('Meet the team leading our community') }}</p>
            </div>

            <!-- Chairman -->
            @php
                $chairman = $leaders->first();
            @endphp
            @if($chairman)
                <div class="max-w-sm mx-auto mb-12">
                    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                        <div class="aspect-square w-full bg-gray-100">
                            @if($chairman->avatar_url)
                                <img src="{{ $chairman->avatar_url }}" 
                                     alt="{{ $chairman->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-6xl font-bold text-gray-400">
                                        {{ strtoupper(substr($chairman->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                {{ $chairman->name }}
                            </h3>
                            <p class="text-blue-primary font-medium mb-3">
                                {{ __('Chairman') }}
                            </p>
                            @if($chairman->email)
                                <p class="text-sm text-gray-600">
                                    {{ $chairman->email }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Board Members -->
            @if($leaders->count() > 1)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6">
                    @foreach($leaders->skip(1) as $leader)
                        <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <div class="aspect-square w-full bg-gray-100">
                                @if($leader->avatar_url)
                                    <img src="{{ $leader->avatar_url }}" 
                                         alt="{{ $leader->name }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-4xl font-bold text-gray-400">
                                            {{ strtoupper(substr($leader->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 text-center">
                                <h3 class="font-bold text-gray-900 mb-1">
                                    {{ $leader->name }}
                                </h3>
                                <p class="text-sm text-blue-primary">
                                    {{ __('Board Member') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
    @endif

    <!-- CTA -->
    <div class="py-20 gradient-blue relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white rounded-full -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full translate-x-1/2 translate-y-1/2"></div>
        </div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-4xl font-bold text-white mb-4">{{ __('Ready to Start?') }}</h2>
            <p class="text-xl text-blue-50 mb-10 max-w-2xl mx-auto">
                {{ __('Join thousands of learners worldwide and unlock your potential') }}
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('register') }}" class="px-10 py-4 bg-white text-blue-primary font-semibold rounded-full hover:bg-gold hover:text-white transition-all duration-300 transform hover:scale-105 shadow-xl">
                    {{ __('Join Now') }}
                </a>
                <a href="{{ route('programs.index') }}" class="px-10 py-4 bg-transparent border-2 border-white text-white font-semibold rounded-full hover:bg-white hover:text-blue-primary transition-all duration-300 transform hover:scale-105">
                    {{ __('Browse Programs') }}
                </a>
            </div>
        </div>
    </div>
</x-app-layout>


