<x-app-layout>
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50 dark:from-gray-900 dark:via-indigo-900 dark:to-purple-900 py-20 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 dark:text-white mb-4">
                {{ __('Welcome back, :name!', ['name' => Auth::user()->name]) }}
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-2xl">
                {{ __('Manage your learning journey and explore new opportunities') }}
            </p>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <!-- Quick Links Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('Quick Links') }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Profile Card -->
                    <a href="{{ route('profile.edit') }}" class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Profile') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Update your personal information and settings') }}
                            </p>
                        </div>
                    </a>

                    <!-- Courses Card -->
                    <a href="{{ route('courses.index') }}" class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Courses') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Access your learning materials and courses') }}
                            </p>
                        </div>
                    </a>

                    <!-- Gallery Card -->
                    <a href="{{ route('gallery.index') }}" class="group bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-200 dark:border-gray-700">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-pink-600 rounded-lg flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                {{ __('Gallery') }}
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ __('View photos and videos from community events') }}
                            </p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Enrolled Programs Section -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ __('My Programs') }}
                </h2>
                @php
                    $enrolledPrograms = Auth::user()->registrations()
                        ->with('program')
                        ->where('status', 'approved')
                        ->get();
                @endphp

                @if($enrolledPrograms->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($enrolledPrograms as $registration)
                            @php
                                $program = $registration->program;
                            @endphp
                            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden border border-gray-200 dark:border-gray-700">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $program->type === 'academy' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200' }}">
                                            {{ ucfirst($program->type) }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ __('Enrolled') }}
                                        </span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                                        {{ $program->getTranslation('name', app()->getLocale()) }}
                                    </h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                        {{ Str::limit($program->getTranslation('description', app()->getLocale()), 100) }}
                                    </p>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-500 dark:text-gray-400">
                                            {{ __('Registered') }}: {{ $registration->created_at->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 p-12 text-center">
                        <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                            {{ __('No Programs Yet') }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-6">
                            {{ __('You haven\'t enrolled in any programs yet. Explore our programs and start your learning journey!') }}
                        </p>
                        <a href="{{ route('programs.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-medium rounded-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                            {{ __('Browse Programs') }}
                            <svg class="w-5 h-5 ms-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
