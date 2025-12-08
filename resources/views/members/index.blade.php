<x-app-layout>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-blue-50 to-white dark:from-dark-bg dark:to-dark-card pt-32 pb-12">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-5xl font-bold text-gray-900 dark:text-gray-100 mb-4 animate-fade-in">
                {{ __('Members Directory') }}
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 animate-slide-up">
                {{ __('Connect with fellow batch members') }}
            </p>
        </div>
    </div>

    <div class="pb-16 bg-gray-50 dark:bg-dark-bg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search and Filter Section -->
            <div class="bg-white dark:bg-dark-card rounded-2xl border-2 border-gray-100 dark:border-dark-border p-8 mb-8 shadow-lg dark:shadow-dark-border">
                <form method="GET" action="{{ route('members.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Search Input -->
                    <div class="md:col-span-2">
                        <label for="search" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            {{ __('Search Members') }}
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                            </div>
                            <input type="text" 
                                   name="search" 
                                   id="search" 
                                   value="{{ request('search') }}"
                                   placeholder="{{ __('Search by name, email, or city...') }}"
                                   class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border bg-white dark:bg-dark-bg text-gray-900 dark:text-gray-100 focus:border-blue-primary dark:focus:border-gold focus:ring-2 focus:ring-blue-100 dark:focus:ring-gold/20 transition-all">
                        </div>
                    </div>

                    <!-- Batch Year Filter -->
                    <div>
                        <label for="batch_year" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            {{ __('Batch Year') }}
                        </label>
                        <select name="batch_year" 
                                id="batch_year"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border bg-white dark:bg-dark-bg text-gray-900 dark:text-gray-100 focus:border-blue-primary dark:focus:border-gold focus:ring-2 focus:ring-blue-100 dark:focus:ring-gold/20 transition-all">
                            <option value="">{{ __('All Batches') }}</option>
                            @foreach($batchYears as $year)
                                <option value="{{ $year }}" {{ request('batch_year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Role Filter -->
                    <div class="md:col-span-3">
                        <label for="role" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            {{ __('Member Type') }}
                        </label>
                        <select name="role" 
                                id="role"
                                class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 dark:border-dark-border bg-white dark:bg-dark-bg text-gray-900 dark:text-gray-100 focus:border-blue-primary dark:focus:border-gold focus:ring-2 focus:ring-blue-100 dark:focus:ring-gold/20 transition-all">
                            <option value="">{{ __('All Members') }}</option>
                            <option value="member_angkatan" {{ request('role') == 'member_angkatan' ? 'selected' : '' }}>
                                {{ __('Member Angkatan') }}
                            </option>
                            <option value="member" {{ request('role') == 'member' ? 'selected' : '' }}>
                                {{ __('Regular Member') }}
                            </option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="md:col-span-3 flex gap-3">
                        <button type="submit" 
                                class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-gold-dark dark:to-gold text-white font-semibold rounded-xl hover:shadow-lg dark:shadow-dark-border transition-all duration-300 transform hover:scale-105">
                            {{ __('Search') }}
                        </button>
                        @if(request('search') || request('batch_year'))
                            <a href="{{ route('members.index') }}" 
                               class="px-8 py-3 bg-gray-100 dark:bg-dark-card text-gray-700 dark:text-gray-300 font-semibold rounded-xl hover:bg-gray-200 dark:hover:bg-dark-border transition-all duration-300">
                                {{ __('Clear') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Members Grid -->
            @if($members->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($members as $member)
                        <div class="bg-white dark:bg-dark-card rounded-2xl shadow-lg dark:shadow-dark-border border-2 border-gray-100 dark:border-dark-border overflow-hidden hover:border-blue-primary dark:hover:border-gold hover:shadow-2xl dark:hover:shadow-gold/20 transition-all duration-300 transform hover:-translate-y-2 group">
                            <!-- Member Avatar -->
                            <div class="aspect-square w-full overflow-hidden bg-gradient-to-br from-blue-600 to-blue-700 dark:from-gold-dark dark:to-gold relative">
                                @if($member->avatar_url)
                                    <img src="{{ $member->avatar_url }}" 
                                         alt="{{ $member->name }}"
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-7xl font-bold text-white">
                                            {{ strtoupper(substr($member->name, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Member Info -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-2 group-hover:text-blue-600 dark:group-hover:text-gold transition-all">
                                    {{ $member->name }}
                                </h3>

                                @if($member->batch_year)
                                    <div class="inline-block px-3 py-1 bg-gradient-to-r from-amber-500 to-amber-600 dark:from-gold-dark dark:to-gold text-white text-xs font-semibold rounded-full mb-3">
                                        {{ __('Batch') }} {{ $member->batch_year }}
                                    </div>
                                @endif

                                @if($member->city)
                                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4">
                                        <svg class="w-4 h-4 mr-2 text-blue-primary dark:text-gold" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $member->city }}
                                    </div>
                                @endif

                                <!-- Social Media Links -->
                                @if($member->instagram_url || $member->linkedin_url || $member->twitter_url)
                                    <div class="flex gap-2 mb-4">
                                        @if($member->instagram_url)
                                            <a href="{{ $member->instagram_url }}" 
                                               target="_blank"
                                               class="w-9 h-9 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->linkedin_url)
                                            <a href="{{ $member->linkedin_url }}" 
                                               target="_blank"
                                               class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->twitter_url)
                                            <a href="{{ $member->twitter_url }}" 
                                               target="_blank"
                                               class="w-9 h-9 bg-black rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->facebook_url)
                                            <a href="{{ $member->facebook_url }}" 
                                               target="_blank"
                                               class="w-9 h-9 bg-blue-600 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->youtube_url)
                                            <a href="{{ $member->youtube_url }}" 
                                               target="_blank"
                                               class="w-9 h-9 bg-red-600 rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                                </svg>
                                            </a>
                                        @endif

                                        @if($member->tiktok_url)
                                            <a href="{{ $member->tiktok_url }}" 
                                               target="_blank"
                                               class="w-9 h-9 bg-black rounded-xl flex items-center justify-center hover:scale-110 transition-transform shadow-md">
                                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                                    <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>
                                @endif

                                <!-- Member Angkatan Badge -->
                                @if($member->role === 'member_angkatan')
                                    <div class="mb-4">
                                        <span class="inline-flex items-center px-3 py-1 bg-blue-50 dark:bg-blue-900/20 text-blue-primary dark:text-gold text-xs font-semibold rounded-full border border-blue-200 dark:border-gold/30">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ __('Member Angkatan') }}
                                        </span>
                                    </div>
                                @endif

                                <a href="{{ route('members.show', $member) }}" 
                                   class="block w-full text-center px-4 py-3 bg-gradient-to-r from-blue-600 to-blue-700 dark:from-gold-dark dark:to-gold text-white font-semibold rounded-xl hover:shadow-lg dark:shadow-dark-border transition-all duration-300 transform hover:scale-105">
                                    {{ __('View Profile') }}
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $members->links() }}
                </div>
            @else
                <div class="bg-white dark:bg-dark-card rounded-lg border border-gray-200 dark:border-dark-border p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 dark:bg-dark-card rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-2">
                        {{ __('No Members Found') }}
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        {{ __('Try adjusting your search or filter criteria') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>


