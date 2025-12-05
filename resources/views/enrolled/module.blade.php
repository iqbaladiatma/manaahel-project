<x-app-layout>
    <div class="flex flex-col lg:flex-row min-h-screen bg-gray-50 mt-16">
        <!-- Sidebar - Module List -->
        <div class="w-full lg:w-96 bg-white border-r border-gray-200 flex-shrink-0 lg:h-[calc(100vh-4rem)] lg:sticky lg:top-16 overflow-y-auto shadow-xl">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-br from-blue-50 via-white to-amber-50">
                <a href="{{ route('enrolled.show', $program->slug) }}" class="group inline-flex items-center text-gray-600 hover:text-blue-600 transition-colors mb-4 font-semibold">
                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    {{ __('Back to Dashboard') }}
                </a>
                <h2 class="text-xl font-bold text-gray-900 mb-4">{{ $course->getTranslation('title', app()->getLocale()) }}</h2>
                
                <!-- Progress Bar -->
                <div class="mt-4">
                    <div class="flex justify-between text-sm text-gray-600 mb-2 font-medium">
                        <span>{{ __('Course Progress') }}</span>
                        <span class="text-blue-600 font-bold">{{ $completionPercentage }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 shadow-inner">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 h-3 rounded-full transition-all duration-500 shadow-sm" style="width: {{ $completionPercentage }}%"></div>
                    </div>
                </div>
            </div>

            <div class="divide-y divide-gray-100">
                @foreach($allModules as $index => $mod)
                    @php
                        $isActive = $mod->id === $module->id;
                        $modProgress = $moduleProgress->get($mod->id);
                        $isCompleted = $modProgress && $modProgress->is_completed;
                    @endphp
                    <a href="{{ route('enrolled.module.show', [$program->slug, $course->slug, $mod->id]) }}" 
                       class="group/item flex items-start p-5 hover:bg-gradient-to-r hover:from-blue-50 hover:to-amber-50 transition-all duration-300 {{ $isActive ? 'bg-gradient-to-r from-blue-50 to-amber-50 border-l-4 border-blue-600' : 'border-l-4 border-transparent' }}">
                        <div class="flex-shrink-0 mr-4 mt-0.5">
                            @if($isCompleted)
                                <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center shadow-md">
                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            @elseif($isActive)
                                <div class="w-8 h-8 border-3 border-blue-600 rounded-lg flex items-center justify-center bg-blue-100 shadow-md">
                                    <div class="w-3 h-3 bg-blue-600 rounded-full"></div>
                                </div>
                            @else
                                <div class="w-8 h-8 border-2 border-gray-300 rounded-lg flex items-center justify-center text-sm text-gray-500 font-semibold group-hover/item:border-blue-400 group-hover/item:text-blue-600 transition-colors">
                                    {{ $index + 1 }}
                                </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-semibold {{ $isActive ? 'text-blue-700' : 'text-gray-700' }} line-clamp-2 group-hover/item:text-blue-600 transition-colors">
                                {{ $mod->getTranslation('title', app()->getLocale()) }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $mod->duration_minutes }} {{ __('min') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Content Section -->
            <div class="flex-1 p-8 overflow-y-auto bg-gradient-to-br from-gray-50 to-white">
                <div class="max-w-6xl mx-auto">
                    <!-- Module Header -->
                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                        <div class="flex-1">
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                                {{ $module->getTranslation('title', app()->getLocale()) }}
                            </h1>
                            @if($module->duration_minutes)
                                <div class="flex items-center text-gray-600 text-base">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">{{ $module->duration_minutes }} {{ __('minutes') }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Mark Complete Button -->
                        @if($progress->is_completed)
                            <button onclick="toggleComplete(false)" class="group flex items-center px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 text-white rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-bold">{{ __('Completed') }}</span>
                            </button>
                        @else
                            <button onclick="toggleComplete(true)" class="group flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="font-bold">{{ __('Mark as Complete') }}</span>
                            </button>
                        @endif
                    </div>

                    <!-- Video Section (Smaller) -->
                    @if($module->video_url)
                        <div class="mb-10">
                            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
                                <div class="bg-gradient-to-r from-blue-50 to-amber-50 px-6 py-4 border-b border-gray-200">
                                    <h3 class="text-lg font-bold text-gray-900 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"/>
                                        </svg>
                                        {{ __('Video Lesson') }}
                                    </h3>
                                </div>
                                <div class="p-4 bg-black">
                                    @php
                                        $videoId = null;
                                        if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $module->video_url, $matches)) {
                                            $videoId = $matches[1];
                                        } elseif (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $module->video_url, $matches)) {
                                            $videoId = $matches[1];
                                        } elseif (preg_match('/youtu\.be\/([^\&\?\/]+)/', $module->video_url, $matches)) {
                                            $videoId = $matches[1];
                                        }
                                    @endphp

                                    @if($videoId)
                                        <div class="relative w-full" style="padding-bottom: 56.25%;">
                                            <iframe 
                                                class="absolute top-0 left-0 w-full h-full rounded-lg" 
                                                src="https://www.youtube.com/embed/{{ $videoId }}?rel=0&modestbranding=1" 
                                                title="{{ $module->getTranslation('title', app()->getLocale()) }}"
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center py-16 text-white">
                                            <div class="text-center">
                                                <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                                <p class="text-gray-400">{{ __('Video format not supported') }}</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Description -->
                    @if($module->description)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 mb-8">
                            <div class="flex items-start">
                                <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('About This Lesson') }}</h3>
                                    <p class="text-gray-700 text-lg leading-relaxed">{{ $module->getTranslation('description', app()->getLocale()) }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Content -->
                    @if($module->content)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 mb-8">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                                    </svg>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">{{ __('Lesson Content') }}</h3>
                            </div>
                            <div class="prose prose-lg max-w-none text-gray-800 leading-relaxed">
                                {!! $module->getTranslation('content', app()->getLocale()) !!}
                            </div>
                        </div>
                    @endif

                    <!-- Empty State - No Content -->
                    @if(!$module->video_url && !$module->description && !$module->content)
                        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-16 text-center">
                            <div class="w-24 h-24 bg-gradient-to-br from-blue-100 to-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ __('Content Coming Soon') }}</h3>
                            <p class="text-gray-600 text-lg max-w-md mx-auto leading-relaxed">{{ __('The lesson materials for this module are being prepared. Please check back later.') }}</p>
                        </div>
                    @endif

                    <!-- Navigation Buttons -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 mt-8">
                        @php
                            $currentIndex = $allModules->search(function($m) use ($module) { return $m->id === $module->id; });
                            $previousModule = $currentIndex > 0 ? $allModules[$currentIndex - 1] : null;
                            $nextModule = $currentIndex < $allModules->count() - 1 ? $allModules[$currentIndex + 1] : null;
                        @endphp

                        <div class="flex items-center justify-between gap-4">
                            @if($previousModule)
                                <a href="{{ route('enrolled.module.show', [$program->slug, $course->slug, $previousModule->id]) }}" 
                                   class="group flex items-center px-6 py-3 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl hover:border-blue-600 hover:text-blue-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    <span class="hidden sm:inline">{{ __('Previous Lesson') }}</span>
                                    <span class="sm:hidden">{{ __('Previous') }}</span>
                                </a>
                            @else
                                <div></div>
                            @endif

                            @if($nextModule)
                                <a href="{{ route('enrolled.module.show', [$program->slug, $course->slug, $nextModule->id]) }}" 
                                   class="group flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5">
                                    <span class="hidden sm:inline">{{ __('Next Lesson') }}</span>
                                    <span class="sm:hidden">{{ __('Next') }}</span>
                                    <svg class="w-6 h-6 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('enrolled.show', $program->slug) }}" 
                                   class="group flex items-center px-8 py-4 bg-gradient-to-r from-green-500 to-emerald-500 text-white font-bold rounded-xl hover:from-green-600 hover:to-emerald-600 transition-all duration-300 shadow-xl hover:shadow-2xl transform hover:-translate-y-0.5">
                                    <svg class="w-6 h-6 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ __('Course Complete!') }}
                                </a>
                            @endif
                        </div>

                        <!-- Progress Indicator -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                                <span class="font-medium">{{ __('Lesson Progress') }}</span>
                                <span class="font-bold text-blue-600">{{ $currentIndex + 1 }} / {{ $allModules->count() }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gradient-to-r from-blue-600 to-blue-700 h-2 rounded-full transition-all duration-300" style="width: {{ (($currentIndex + 1) / $allModules->count()) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleComplete(markComplete) {
            const url = markComplete 
                ? '{{ route("enrolled.module.complete", [$program->slug, $course->slug, $module->id]) }}'
                : '{{ route("enrolled.module.uncomplete", [$program->slug, $course->slug, $module->id]) }}';

            fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>
</x-app-layout>
