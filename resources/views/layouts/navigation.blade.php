<nav x-data="{ open: false }" 
     class="fixed w-full top-0 z-50 bg-white dark:bg-dark-bg shadow-md dark:shadow-dark-border transition-colors duration-200">
    
    <!-- Overlay -->
    <div x-show="open" 
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-40"
         style="display: none;">
    </div>

    <!-- Sidebar -->
    <div x-show="open"
         x-transition:enter="transition ease-in-out duration-300 transform"
         x-transition:enter-start="-translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in-out duration-300 transform"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="-translate-x-full"
         class="fixed top-0 left-0 h-full w-80 bg-white dark:bg-dark-bg shadow-2xl z-50 overflow-y-auto"
         style="display: none;">
        
        <!-- Sidebar Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-dark-border">
            <a href="/" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 gradient-blue rounded-lg flex items-center justify-center shadow-md">
                    <span class="text-white font-bold text-xl">M</span>
                </div>
                <span class="text-xl font-bold text-blue-primary dark:text-gold">Manaahel</span>
            </a>
            <button @click="open = false" class="p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-dark-card transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Sidebar Navigation -->
        <div class="p-6 space-y-2">
            @auth
            <!-- Member Navigation -->
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Dashboard
            </a>
            <a href="{{ route('programs.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Program
            </a>
            <a href="{{ route('academy.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Academy
            </a>
            <a href="{{ route('members.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Anggota
            </a>
            <a href="{{ route('gallery.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                Galeri
            </a>
            <a href="{{ route('articles.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                Artikel
            </a>
            @else
            <!-- Public Navigation -->
            <a href="{{ route('home') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Beranda
            </a>
            <a href="{{ route('about') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Tentang
            </a>
            <a href="{{ route('programs.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                Program
            </a>
            <a href="{{ route('academy.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                Academy
            </a>
            <a href="{{ route('articles.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                Artikel
            </a>
            <a href="{{ route('map.index') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                </svg>
                Peta
            </a>
            @endauth
        </div>

        <!-- Sidebar Footer -->
        <div class="border-t border-gray-200 dark:border-dark-border p-6 space-y-3">
            @auth
            <!-- User Info -->
            <div class="px-4 py-3 bg-blue-50 dark:bg-dark-card rounded-lg">
                <div class="font-medium text-sm text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profil
            </a>

            @if(Auth::user()->isAdmin())
            <a href="{{ route('filament.admin.pages.dashboard') }}" class="flex items-center px-4 py-3 text-base font-medium gradient-gold text-white rounded-lg hover:opacity-90 transition-all duration-200 shadow-md">
                <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                </svg>
                Panel Admin
            </a>
            @endif

            <!-- Dark Mode Toggle -->
            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-dark-card rounded-lg">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mode Gelap</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="darkModeToggleSidebar" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-gold/50 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gold"></div>
                </label>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center px-4 py-3 text-base font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Keluar
                </button>
            </form>
            @else
            <a href="{{ route('login') }}" class="flex items-center justify-center px-4 py-3 text-base font-medium text-blue-600 dark:text-gold border-2 border-blue-600 dark:border-gold hover:bg-blue-50 dark:hover:bg-dark-card rounded-lg transition-all duration-200">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="flex items-center justify-center px-4 py-3 text-base font-medium text-white gradient-gold rounded-lg hover:opacity-90 transition shadow-md">
                Daftar Akun
            </a>

            <!-- Dark Mode Toggle -->
            <div class="flex items-center justify-between px-4 py-3 bg-gray-50 dark:bg-dark-card rounded-lg">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Mode Gelap</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="darkModeToggleSidebar" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-gold/50 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-gold"></div>
                </label>
            </div>
            @endauth
        </div>
    </div>

    <!-- Top Navigation Bar -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <!-- Hamburger Button & Logo -->
            <div class="flex items-center space-x-4">
                <!-- Hamburger Button -->
                <button @click="open = true" class="p-2 rounded-lg text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 hover:bg-gray-100 dark:hover:bg-dark-card transition-all duration-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>

                <!-- Logo -->
                <a href="/" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 gradient-blue rounded-lg flex items-center justify-center shadow-md">
                        <span class="text-white font-bold text-xl">M</span>
                    </div>
                    <span class="text-xl font-bold text-blue-primary dark:text-gold">Manaahel</span>
                </a>
            </div>

            <!-- Right Side Actions -->
            <div class="flex items-center space-x-2">
                @auth
                @if(Auth::user()->isAdmin())
                <a href="{{ route('filament.admin.pages.dashboard') }}" 
                   class="hidden sm:inline-flex items-center px-3 py-2 gradient-gold text-white text-sm font-semibold rounded-lg hover:shadow-lg transition-all duration-200">
                    <svg class="w-4 h-4 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                    </svg>
                    <span class="hidden sm:inline">Admin</span>
                </a>
                @endif
                @else
                <a href="{{ route('login') }}" class="hidden sm:inline-flex px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-gold transition-colors duration-200">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="hidden sm:inline-flex gradient-gold text-white px-4 py-2 rounded-full text-sm font-medium hover:opacity-90 transition shadow-md">
                    Daftar
                </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

