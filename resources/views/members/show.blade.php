<x-app-layout>
    <div class="py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('members.index') }}" 
                   class="inline-flex items-center text-blue-primary hover:text-blue-600 transition-colors font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Members') }}
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Card -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl border-2 border-gray-100 overflow-hidden sticky top-24">
                        <!-- Avatar -->
                        <div class="aspect-square w-full overflow-hidden gradient-blue relative">
                            @if($member->avatar_url)
                                <img src="{{ $member->avatar_url }}" 
                                     alt="{{ $member->name }}"
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <span class="text-9xl font-bold text-white">
                                        {{ strtoupper(substr($member->name, 0, 1)) }}
                                    </span>
                                </div>
                            @endif
                            
                            <!-- Member Angkatan Badge -->
                            @if($member->isMemberAngkatan())
                                <div class="absolute top-4 right-4">
                                    <span class="inline-flex items-center px-3 py-1.5 bg-white/90 backdrop-blur-sm text-blue-primary text-xs font-bold rounded-full shadow-lg">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Member Angkatan
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Profile Info -->
                        <div class="p-6">
                            <h1 class="text-2xl font-bold text-gray-900 mb-2">
                                {{ $member->name }}
                            </h1>

                            @if($member->batch_year)
                                <div class="inline-block px-4 py-1.5 gradient-gold text-white text-sm font-semibold rounded-full mb-4">
                                    {{ __('Batch') }} {{ $member->batch_year }}
                                </div>
                            @endif

                            <!-- Contact Info -->
                            <div class="space-y-3 mb-6">
                                @if($member->email)
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-3 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $member->email }}</span>
                                    </div>
                                @endif

                                @if($member->phone)
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-3 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $member->phone }}</span>
                                    </div>
                                @endif

                                @if($member->city)
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-5 h-5 mr-3 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        <span class="text-sm">{{ $member->city }}</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Social Media Links -->
                            @if($member->instagram_url || $member->linkedin_url || $member->twitter_url || $member->facebook_url || $member->youtube_url || $member->tiktok_url)
                                <div class="border-t border-gray-200 pt-6">
                                    <h3 class="text-sm font-semibold text-gray-900 mb-3">
                                        {{ __('Social Media') }}
                                    </h3>
                                    <div class="grid grid-cols-3 gap-3">
                                        @if($member->instagram_url)
                                            <a href="{{ $member->instagram_url }}" 
                                               target="_blank"
                                               class="w-full aspect-square bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->linkedin_url)
                                            <a href="{{ $member->linkedin_url }}" 
                                               target="_blank"
                                               class="w-full aspect-square bg-blue-600 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->twitter_url)
                                            <a href="{{ $member->twitter_url }}" 
                                               target="_blank"
                                               class="w-full aspect-square bg-black rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->facebook_url)
                                            <a href="{{ $member->facebook_url }}" 
                                               target="_blank"
                                               class="w-full aspect-square bg-blue-600 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->youtube_url)
                                            <a href="{{ $member->youtube_url }}" 
                                               target="_blank"
                                               class="w-full aspect-square bg-red-600 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->tiktok_url)
                                            <a href="{{ $member->tiktok_url }}" 
                                               target="_blank"
                                               class="w-full aspect-square bg-black rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Content Area -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Bio Section -->
                    @if($member->bio)
                        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('About') }}
                            </h2>
                            <p class="text-gray-600 leading-relaxed text-lg">
                                {{ $member->bio }}
                            </p>
                        </div>
                    @endif

                    <!-- Galleries Section (Member Angkatan Only) -->
                    @if($member->isMemberAngkatan() && isset($member->galleries) && $member->galleries->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                                {{ __('Gallery') }}
                            </h2>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                @foreach($member->galleries as $gallery)
                                    <div class="aspect-square overflow-hidden rounded-xl border-2 border-gray-100 hover:border-blue-primary transition-all duration-300 group">
                                        @if($gallery->type === 'image' && $gallery->media_url)
                                            <img src="{{ $gallery->media_url }}" 
                                                 alt="{{ $gallery->getTranslation('title', app()->getLocale()) }}"
                                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        @else
                                            <div class="w-full h-full gradient-blue flex items-center justify-center">
                                                <svg class="w-12 h-12 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Enrolled Programs -->
                    @php
                        $enrolledPrograms = $member->registrations()
                            ->with('program')
                            ->where('status', 'approved')
                            ->get();
                    @endphp

                    @if($enrolledPrograms->count() > 0)
                        <div class="bg-white rounded-2xl shadow-lg border-2 border-gray-100 p-8">
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-primary" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                                </svg>
                                {{ __('Enrolled Programs') }}
                            </h2>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($enrolledPrograms as $registration)
                                    @php
                                        $program = $registration->program;
                                    @endphp
                                    <div class="border-2 border-gray-100 rounded-xl p-5 hover:border-blue-primary hover:shadow-lg transition-all duration-300">
                                        <div class="flex items-center justify-between mb-3">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $program->type === 'academy' ? 'gradient-blue text-white' : 'gradient-gold text-white' }}">
                                                {{ ucfirst($program->type) }}
                                            </span>
                                        </div>
                                        <h3 class="font-bold text-gray-900 mb-2">
                                            {{ $program->getTranslation('name', app()->getLocale()) }}
                                        </h3>
                                        <p class="text-sm text-gray-600">
                                            {{ __('Enrolled') }}: {{ $registration->created_at->format('M d, Y') }}
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
