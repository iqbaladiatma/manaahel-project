<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-50 via-white to-gold/5 pt-24 sm:pt-28 md:pt-32 pb-8 sm:pb-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-3 sm:mb-4 animate-fade-in">
                {{ __('Program Kami') }}
            </h1>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-2xl mx-auto animate-slide-up">
                {{ __('Pilih program sesuai kebutuhan Anda') }}
            </p>
        </div>
    </div>

    <div class="pb-12 sm:pb-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filter Tabs -->
            <div class="flex justify-center mb-8 sm:mb-12">
                <div class="inline-flex flex-wrap justify-center rounded-full border-2 border-gray-200 p-1 bg-white shadow-md gap-1">
                    <a href="{{ route('programs.index') }}" 
                       class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-sm sm:text-base font-medium transition {{ !request('type') ? 'gradient-blue text-white' : 'text-gray-700 hover:text-blue-primary' }}">
                        {{ __('Semua') }}
                    </a>
                    <a href="{{ route('programs.index', ['type' => 'academy']) }}" 
                       class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-sm sm:text-base font-medium transition {{ request('type') === 'academy' ? 'gradient-blue text-white' : 'text-gray-700 hover:text-blue-primary' }}">
                        {{ __('Academy') }}
                    </a>
                    <a href="{{ route('programs.index', ['type' => 'competition']) }}" 
                       class="px-4 sm:px-6 py-2 sm:py-2.5 rounded-full text-sm sm:text-base font-medium transition {{ request('type') === 'competition' ? 'gradient-gold text-white' : 'text-gray-700 hover:text-blue-primary' }}">
                        {{ __('Competition') }}
                    </a>
                </div>
            </div>

            @if($programs->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                        {{ __('Belum Ada Program') }}
                    </h3>
                    <p class="text-gray-600">
                        {{ __('Program akan segera hadir') }}
                    </p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                    @foreach($programs as $program)
                        <div class="bg-white rounded-xl sm:rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 group">
                            <div class="{{ $program->type === 'academy' ? 'gradient-blue' : 'gradient-gold' }} h-32 sm:h-40 relative overflow-hidden">
                                <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                                <div class="absolute bottom-4 left-6">
                                    <span class="inline-block bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold border border-white/30">
                                        {{ ucfirst($program->type) }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-5 h-5 mr-2 {{ $program->type === 'academy' ? 'text-blue-primary' : 'text-gold' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ $program->start_date->format('M d, Y') }}
                                    </div>
                                    
                                    @if($program->status)
                                        <span class="flex items-center px-3 py-1.5 rounded-full text-xs font-semibold bg-green-50 text-green-600 border border-green-200">
                                            <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                            {{ __('Dibuka') }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-600 border border-gray-200">
                                            {{ __('Ditutup') }}
                                        </span>
                                    @endif
                                </div>

                                <h3 class="text-2xl font-bold text-gray-900 mb-3 group-hover:{{ $program->type === 'academy' ? 'text-blue-primary' : 'text-gold' }} transition-colors">
                                    {{ $program->getTranslation('name', app()->getLocale()) }}
                                </h3>

                                <p class="text-gray-600 mb-6 leading-relaxed line-clamp-3">
                                    {{ $program->getTranslation('description', app()->getLocale()) }}
                                </p>

                                <div class="flex items-center justify-between mb-6 pb-6 border-b border-gray-100">
                                    <span class="text-sm text-gray-500 font-medium">{{ __('Biaya Program') }}</span>
                                    <div class="text-3xl font-bold {{ $program->type === 'academy' ? 'gradient-blue-text' : 'gradient-gold-text' }}">
                                        @if($program->fees > 0)
                                            Rp {{ number_format($program->fees, 0, ',', '.') }}
                                        @else
                                            {{ __('Gratis') }}
                                        @endif
                                    </div>
                                </div>

                                <a href="{{ route('programs.show', $program->slug) }}" 
                                   class="block w-full text-center px-6 py-4 {{ $program->type === 'academy' ? 'gradient-blue' : 'gradient-gold' }} text-white font-semibold rounded-full hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                    {{ __('Lihat Detail') }} →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $programs->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>

