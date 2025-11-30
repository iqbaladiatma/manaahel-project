<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gallery') }}
        </h2>
    </x-slot>

    @if($galleries->where('visibility', 'member_only')->isNotEmpty())
        <x-slot name="meta">
            <meta name="robots" content="noindex, nofollow">
        </x-slot>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($galleries->isEmpty())
                        <p class="text-gray-600 dark:text-gray-400">{{ __('No gallery items available at the moment.') }}</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($galleries as $gallery)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                    <!-- Gallery Image/Video -->
                                    <div class="aspect-video bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        @if(Str::endsWith($gallery->file_path, ['.jpg', '.jpeg', '.png', '.gif', '.webp']))
                                            <img src="{{ Storage::url($gallery->file_path) }}" 
                                                 alt="{{ $gallery->title }}"
                                                 class="w-full h-full object-cover">
                                        @elseif(Str::endsWith($gallery->file_path, ['.mp4', '.webm', '.ogg']))
                                            <video controls class="w-full h-full">
                                                <source src="{{ Storage::url($gallery->file_path) }}" type="video/{{ pathinfo($gallery->file_path, PATHINFO_EXTENSION) }}">
                                                {{ __('Your browser does not support the video tag.') }}
                                            </video>
                                        @else
                                            <span class="text-gray-500">{{ __('Media file') }}</span>
                                        @endif
                                    </div>

                                    <!-- Gallery Info -->
                                    <div class="p-4">
                                        <h3 class="text-lg font-bold mb-2">
                                            {{ $gallery->title }}
                                        </h3>

                                        <!-- Visibility Badge -->
                                        <div class="flex items-center gap-2">
                                            @if($gallery->visibility === 'member_only')
                                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    {{ __('Members Only') }}
                                                </span>
                                            @else
                                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                    {{ __('Public') }}
                                                </span>
                                            @endif

                                            @if($gallery->batch_filter)
                                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200">
                                                    {{ __('Batch') }} {{ $gallery->batch_filter }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
