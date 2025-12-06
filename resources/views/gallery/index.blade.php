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
            
            <!-- Upload Button for Member Angkatan -->
            @auth
                @if(Auth::user()->isMemberAngkatan())
                    <div class="mt-6">
                        <a href="{{ route('gallery.create') }}" 
                           class="inline-flex items-center px-8 py-4 gradient-gold text-white font-semibold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"/>
                            </svg>
                            {{ __('Upload Photo') }}
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    <div class="pb-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
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
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($galleries as $gallery)
                        <div class="group relative aspect-square overflow-hidden rounded-2xl border-2 border-gray-100 hover:border-blue-primary transition-all duration-300 transform hover:-translate-y-2 hover:shadow-2xl cursor-pointer">
                            <img src="{{ $gallery->file_path }}" 
                                 alt="{{ $gallery->title }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    <h3 class="text-white font-semibold text-base mb-1">{{ $gallery->title }}</h3>
                                    <p class="text-blue-100 text-sm">{{ __('Click to view') }}</p>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <svg class="w-5 h-5 text-blue-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
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


