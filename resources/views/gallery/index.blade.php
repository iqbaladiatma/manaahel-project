<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-50 to-white pt-32 pb-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold text-gray-900 mb-4 animate-fade-in">
                {{ __('Gallery') }}
            </h1>
            <p class="text-xl text-gray-600 animate-slide-up">
                {{ __('Photos and videos from our community events') }}
            </p>
            
            <!-- Upload Button for Member Angkatan & Admin -->
            @auth
                @if(Auth::user()->isMemberAngkatan() || Auth::user()->isAdmin())
                    <div class="mt-6">
                        <a href="{{ route('gallery.create') }}" 
                           class="inline-flex items-center px-8 py-4 gradient-gold text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Upload Photo') }}
                        </a>
                    </div>
                @else
                    <!-- Debug: Show user role if not authorized -->
                    <div class="mt-6 text-sm text-gray-500">
                        {{ __('Your role') }}: {{ Auth::user()->role }}
                    </div>
                @endif
            @else
                <!-- Not logged in -->
                <div class="mt-6">
                    <a href="{{ route('login') }}" 
                       class="inline-flex items-center px-8 py-4 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition-all duration-300">
                        {{ __('Login to Upload Photos') }}
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <div class="pb-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Upload Button (Alternative Position - Always Visible for Auth Users) -->
            @auth
                @if(Auth::user()->isMemberAngkatan() || Auth::user()->isAdmin())
                    <div class="mb-8 flex justify-end">
                        <a href="{{ route('gallery.create') }}" 
                           class="inline-flex items-center px-6 py-3 gradient-gold text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Upload Photo') }}
                        </a>
                    </div>
                @endif
            @endauth
            
            @if($galleries->isEmpty())
                <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ __('No Photos Yet') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('Check back later for event photos') }}
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($galleries as $gallery)
                        <div class="bg-white rounded-2xl border-2 border-gray-100 overflow-hidden hover:border-blue-primary hover:shadow-xl transition-all duration-300">
                            <!-- Image -->
                            <div class="aspect-video w-full overflow-hidden bg-gray-100">
                                @if($gallery->media_url)
                                    <img src="{{ $gallery->media_url }}" 
                                         alt="{{ $gallery->getTranslation('title', app()->getLocale()) }}"
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-16 h-16 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="p-5">
                                <!-- Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">
                                    {{ $gallery->getTranslation('title', app()->getLocale()) }}
                                </h3>

                                <!-- Description -->
                                @if($gallery->description)
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2 leading-relaxed">
                                        {{ $gallery->description }}
                                    </p>
                                @endif

                                <!-- Meta Info -->
                                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                                    <!-- Member Info -->
                                    @if($gallery->user)
                                        <div class="flex items-center">
                                            @if($gallery->user->avatar_url)
                                                <img src="{{ $gallery->user->avatar_url }}" 
                                                     alt="{{ $gallery->user->name }}"
                                                     class="w-8 h-8 rounded-full object-cover mr-2 border-2 border-blue-100">
                                            @else
                                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mr-2 border-2 border-blue-100">
                                                    <span class="text-white text-xs font-bold">
                                                        {{ strtoupper(substr($gallery->user->name, 0, 1)) }}
                                                    </span>
                                                </div>
                                            @endif
                                            <div>
                                                <p class="text-xs font-semibold text-gray-900">{{ $gallery->user->name }}</p>
                                                @if($gallery->user->batch_year)
                                                    <p class="text-xs text-gray-500">{{ __('Batch') }} {{ $gallery->user->batch_year }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-400 to-gray-500 flex items-center justify-center mr-2">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div>
                                                <p class="text-xs font-semibold text-gray-900">{{ __('General') }}</p>
                                                <p class="text-xs text-gray-500">{{ __('Gallery') }}</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Date -->
                                    @if($gallery->event_date)
                                        <div class="text-right">
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($gallery->event_date)->format('M d, Y') }}
                                            </p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $galleries->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>


